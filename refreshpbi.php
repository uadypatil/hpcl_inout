<iframe title="SINNAR_dash" class="container-fluid" height="700" width="1000" id="reportcontainer"
                         src="https://app.powerbi.com/view?r=eyJrIjoiYWFhY2E1ODEtNTRkMS00ZGMwLWE3MDktMzE5NjM4ZjZjODZmIiwidCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSJ9"
                         frameborder="0" allowFullScreen="true"></iframe>

                         <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power BI Dataset Refresh</title>
</head>
<body>
    <h1>Power BI Dataset Refresh Example</h1>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const tenantId = '74d78a88-5c14-44bb-b3c8-41b4fdeac6d1';
            const clientId = '4a9a377c-db23-49c5-818d-a655cf170efe';
            const clientSecret = 'f5W8Q~x0Ij3dsfVa-~CMoojN~q5E-VEiUDjuxbD8';
            const datasetId = 'fa8be19d-a0f0-4592-9f6b-c35dbead8f20';
            const groupId = 'me';

            const getAccessToken = async () => {
                const url = `https://login.microsoftonline.com/${tenantId}/oauth2/v2.0/token`;
                const data = {
                    grant_type: 'client_credentials',
                    client_id: clientId,
                    client_secret: clientSecret,
                    scope: 'https://analysis.windows.net/powerbi/api/.default'
                };

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(data)
                });

                const result = await response.json();
                return result.access_token;
            };

            const refreshDataset = async (accessToken) => {
                const url = `https://api.powerbi.com/v1.0/myorg/groups/${groupId}/datasets/${datasetId}/refreshes`;

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    console.log('Dataset refresh started successfully');
                } else {
                    console.error('Error starting dataset refresh', await response.text());
                }
            };

            try {
                const accessToken = await getAccessToken();
                await refreshDataset(accessToken);
            } catch (error) {
                console.error('Error refreshing dataset', error);
            }
        });
    </script>
</body>
</html>

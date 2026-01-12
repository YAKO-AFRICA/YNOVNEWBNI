const apiClient = axios.create({
    baseURL: 'https://api.yakoafricassur.com/enov/',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    }
});

export function getPropositions() {
    return apiClient.get('getTestDsi')
    .then(response => {
        if (!response.data.error && response.data.data && !response.data.data.error) {
            return response.data.data.communeList;
        }
        return [];
    })
    .catch(error => {
        console.error('Erreur API:', error);
        return [];
    });
}

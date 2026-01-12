import { getPropositions } from './reduce.js';

document.addEventListener('DOMContentLoaded', function() {
    let resultBody = document.getElementById('result');
    if (!resultBody) return; // Vérifie que l'élément existe pour éviter les erreurs

    getPropositions().then(communeList => {

        resultBody.innerHTML = ""; // Vider le tableau
        
        if (communeList.length > 0) {
            resultBody.innerHTML = communeList.map(item => `
                <tr>
                    <td>${item.IdTblBranche}</td>
                    <td>${item.CodeBranche}</td>
                    <td>${item.MonLibelle}</td>
                    <td>${item.ID_Old}</td>
                </tr>
            `).join('');
        } else {
            resultBody.innerHTML = '<tr><td colspan="4" class="text-danger text-center">Aucune donnée valide reçue</td></tr>';
        }
    });
});

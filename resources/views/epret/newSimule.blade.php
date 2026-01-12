@extends('layouts.main')
@section('content')
{{-- <h1>Simulateur</h1>
<form id="simulateur-form">
    <label>Age: <input type="number" id="age" required></label><br>
    <label>Durée (mois): <input type="number" id="duree" required></label><br>
    <label>Montant du prêt: <input type="number" id="montant" required></label><br>
    <label>Genre: 
        <select id="genre" required>
            <option value="femme">Femme</option>
            <option value="homme">Homme</option>
        </select>
    </label><br>
    <label>Poids: <input type="number" id="poids" required></label><br>
    <label>Taille (cm): <input type="number" id="taille" required></label><br>
    <button type="submit">Simuler</button>
</form>
<div id="resultat"></div>

<script>
    document.getElementById("simulateur-form").addEventListener("submit", function(e) {
        e.preventDefault();
        
        const age = parseInt(document.getElementById("age").value);
        const duree = parseInt(document.getElementById("duree").value);
        const montant = parseFloat(document.getElementById("montant").value);
        const genre = document.getElementById("genre").value;
        const poids = parseFloat(document.getElementById("poids").value);
        const taille = parseFloat(document.getElementById("taille").value);

        if (age > 61 || duree > 36) {
            document.getElementById("resultat").innerText = "Veuillez contacter YAKO AFRICA.";
            return;
        }

        // Déduction du poids corrigé
        let poidsCorrige = poids;
        if (age < 25) {
            poidsCorrige += (genre === "femme") ? 6 : 4;
        }

        // Calcul du rapport poids-taille (RPT)
        const RPT = ((poidsCorrige / (taille - 100)) - 1).toFixed(2);

        // Déduction de la surmortalité
        let surmortalite = 0;
        if (RPT <= -0.5 || RPT >= 0.8) {
            document.getElementById("resultat").innerText = "Veuillez contacter la LOYALE VIE.";
            return;
        } else if (RPT >= -0.49 && RPT <= -0.25) {
            surmortalite = 50;
        } else if (RPT >= -0.24 && RPT <= 0.24) {
            surmortalite = 0;
        } else if (RPT >= 0.25 && RPT <= 0.39) {
            surmortalite = 25;
        } else if (RPT >= 0.4 && RPT <= 0.49) {
            surmortalite = 50;
        } else if (RPT >= 0.5 && RPT <= 0.59) {
            surmortalite = 75;
        } else if (RPT >= 0.6 && RPT <= 0.69) {
            surmortalite = 100;
        } else if (RPT >= 0.7 && RPT <= 0.79) {
            surmortalite = 150;
        }

        // Déduction du taux prime
        let tauxPrime = 0;
        if (duree >= 1 && duree <= 12) {
            tauxPrime = 0.009;
        } else if (duree >= 13 && duree <= 24) {
            tauxPrime = 0.012;
        } else if (duree >= 25 && duree <= 36) {
            tauxPrime = 0.0195;
        }

        // Calcul de la garantie décès
        const garantieDeces = montant * tauxPrime;

        // Calcul de la prime
        const prime = garantieDeces * (1 + surmortalite / 100);

        // Affichage du résultat
        document.getElementById("resultat").innerHTML = `
            <p>Poids corrigé: ${poidsCorrige} kg</p>
            <p>RPT: ${RPT}</p>
            <p>Surmortalité: ${surmortalite}%</p>
            <p>Garantie Décès: ${garantieDeces.toFixed(2)} €</p>
            <p>Prime: ${prime.toFixed(2)} €</p>
        `;
    });
</script> --}}



{{-- mon premier simulateur obsolete --}}

{{-- <script>
    document.getElementById('simulateButton').addEventListener('click', function () {
        const loanAmount = parseFloat(document.getElementById('loanAmount').value) || 0;
        const loanDuration = parseInt(document.getElementById('loanDuration').value) || 0;
        const disableYako = document.getElementById('disableYako').checked;
        const yakoGuaranteeAmount = 5000;

        let loanCoverage = 0;
        let pamfRisk = 0;

        if (loanAmount > 50000000) {
            alert("Veuillez contacter directement l'agence pour un montant supérieur à 30 000 000 millions.");
            return;
        }

        let interestRate = 0;
        if (loanDuration >= 1 && loanDuration <= 24) {
            interestRate = 0.005;
        } else if (loanDuration >= 25 && loanDuration <= 36) {
            interestRate = 0.008;
        } else if (loanDuration >= 37 && loanDuration <= 48) {
            interestRate = 0.01;
        } else if (loanDuration >= 49 && loanDuration <= 60) {
            interestRate = 0.013;
        } else {
            alert("Durée invalide. Veuillez entrer une durée entre 1 et 60 mois.");
            return;
        }

        loanCoverage = loanAmount * interestRate;
        pamfRisk = loanCoverage;

        const yakoGuarantee = disableYako ? 0 : yakoGuaranteeAmount;
        const totalPremium = loanCoverage + pamfRisk + yakoGuarantee;

        // Update the results
        document.getElementById('loanCoverage').innerText = loanCoverage.toFixed(2);
        document.getElementById('pamfRisk').innerText = pamfRisk.toFixed(2);
        document.getElementById('yakoGuarantee').innerText = yakoGuarantee;
        document.getElementById('totalPremium').innerText = totalPremium.toFixed(2);
    });
</script> --}}

<h1>Simulateur de Surprime</h1>
    <form id="simulateur-form">
        <label>Âge saisi (années) : <input type="number" id="age" required></label><br>
        <label>Durée du contrat (mois) : <input type="number" id="duree" required></label><br>
        <label>Montant du prêt : <input type="number" id="montant" required></label><br>
        <label>Genre : 
            <select id="genre" required>
                <option value="femme">Femme</option>
                <option value="homme">Homme</option>
            </select>
        </label><br>
        <label>Poids (kg) : <input type="number" id="poids" required></label><br>
        <label>Taille (cm) : <input type="number" id="taille" required></label><br>
        <button type="submit">Calculer</button>
    </form>
    <div id="resultat"></div>

    <script>
        document.getElementById("simulateur-form").addEventListener("submit", function(event) {
            event.preventDefault();

            // Récupération des données du formulaire
            const age = parseInt(document.getElementById("age").value);
            const duree = parseInt(document.getElementById("duree").value);
            const montant = parseFloat(document.getElementById("montant").value);
            const genre = document.getElementById("genre").value;
            const poids = parseFloat(document.getElementById("poids").value);
            const taille = parseFloat(document.getElementById("taille").value);

            // Validation des âges non pris en charge
            if (age > 74) {
                document.getElementById("resultat").innerText = "Veuillez contacter Yako Africa.";
                return;
            }

            if (duree > 36) {
                document.getElementById("resultat").innerText = "Veuillez contacter Yako Africa.";
                return;
            }

            // Calcul du poids corrigé (PC)
            let poidsCorrige = poids;
            if (genre === "femme" && age < 25) {
                poidsCorrige += 6;
            } else if (genre === "homme" && age < 25) {
                poidsCorrige += 4;
            }

            // Calcul du rapport poids/taille (RPT)
            const rpt = parseFloat(((poidsCorrige / (taille - 100)) - 1).toFixed(2));

            // Déduction de l'indice de surmortalité à partir du tableau
            let indiceSurmortalite = 0;
            if (rpt <= -0.5 || rpt >= 0.8) {
                document.getElementById("resultat").innerText = "Veuillez contacter la LOYALE VIE.";
                return;
            } else if (rpt >= -0.49 && rpt <= -0.25) {
                indiceSurmortalite = 50;
            } else if (rpt >= -0.24 && rpt <= 0.24) {
                indiceSurmortalite = 0;
            } else if (rpt >= 0.25 && rpt <= 0.39) {
                indiceSurmortalite = 25;
            } else if (rpt >= 0.4 && rpt <= 0.49) {
                indiceSurmortalite = 50;
            } else if (rpt >= 0.5 && rpt <= 0.59) {
                indiceSurmortalite = 75;
            } else if (rpt >= 0.6 && rpt <= 0.69) {
                indiceSurmortalite = 100;
            } else if (rpt >= 0.7 && rpt <= 0.79) {
                indiceSurmortalite = 150;
            }

            // Déduction du taux de conversion en fonction de l'âge saisi
            let tauxConversion = 0;
            if (age < 40) {
                tauxConversion = 30;
            } else if (age >= 40 && age <= 44) {
                tauxConversion = 35;
            } else if (age >= 45 && age <= 49) {
                tauxConversion = 35;
            } else if (age >= 50 && age <= 54) {
                tauxConversion = 40;
            } else if (age >= 55 && age <= 59) {
                tauxConversion = 45;
            } else if (age >= 60 && age <= 64) {
                tauxConversion = 65;
            } else if (age >= 65 && age <= 69) {
                tauxConversion = 65;
            } else if (age >= 70 && age <= 74) {
                tauxConversion = 80;
            }

            // Calcul du taux de surprime
            const tauxSurprime = (tauxConversion / 100) * (indiceSurmortalite / 100);

            // Calcul de la garantie décès
            let tauxPrime = 0;
            if (duree >= 1 && duree <= 12) {
                tauxPrime = 0.009;
            } else if (duree >= 13 && duree <= 24) {
                tauxPrime = 0.012;
            } else if (duree >= 25 && duree <= 36) {
                tauxPrime = 0.0195;
            }

            const garantieDeces = montant * tauxPrime;

            // Calcul de la prime
            const prime = garantieDeces * (1 + tauxSurprime);

            // Résultat final
            document.getElementById("resultat").innerHTML = `

                <p>Poids corrigé: ${poidsCorrige} kg</p>
                <p>RPT: ${rpt}</p>
                <p>Surmortalité: ${indiceSurmortalite}%</p>
                <p>Garantie Décès : ${garantieDeces.toFixed(2)} Fcfa</p>
                <p>Taux Surprime : ${(tauxSurprime * 100).toFixed(2)} %</p>
                <p>Prime totale : ${prime.toFixed(2)} Fcfa</p>
            `;
        });
    </script>

@endsection



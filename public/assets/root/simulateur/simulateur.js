{/* <script> */}
document.getElementById("loanSimulatorForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const birthdayInput = document.getElementById('birthday');
    const birthday = new Date(birthdayInput.value);
    const dateNaissance = `${birthday.getDate()}-${birthday.getMonth() + 1}-${birthday.getFullYear()}`;

    const today = new Date();
    const age = today.getFullYear() - birthday.getFullYear();

    const duree = parseInt(document.getElementById("loanDuration").value);
    const montant = parseFloat(document.getElementById("loanMontant").value);
    const genre = document.getElementById("genre").value;
    const poids = parseFloat(document.getElementById("poids").value);
    const taille = parseFloat(document.getElementById("taille").value);

    

    // Validation des âges non pris en charge
    if (age > 61) {
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
        document.getElementById("resultat").innerText = "Veuillez contacter la YAKO AFRICA.";
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

    // Calcul du taux de prime
    let tauxPrime = 0;
    if (duree >= 1 && duree <= 12) {
        tauxPrime = 0.009;
    } else if (duree >= 13 && duree <= 24) {
        tauxPrime = 0.012;
    } else if (duree >= 25 && duree <= 36) {
        tauxPrime = 0.0195;
    }

    // calculte de prime obseque yako aboseque optionnelle
    
    let primeObseque = 0;
    if (age >= 18 && age <= 55) {
        primeObseque = 5000;
    } else if (age >= 56 && age <= 65) {
        primeObseque = 12700;
    }
    const disableYako = document.getElementById('disableYako').checked; // si yako es cochér alors yako guarantee sera 0
    const yakoGuaranteeAmount = primeObseque;
    const yakoGuarantee = disableYako ? 0 : yakoGuaranteeAmount;
    document.getElementById('primeObseque').innerText = yakoGuarantee.toFixed(2); // resultat mise a jour dans id selectionné

    if (disableYako) {
        document.getElementById('primeObsequeCard').style.display = "none";
    }else{
        document.getElementById('primeObsequeCard').style.display = "block";
    }



    // Calcul de la prime emprunteur = garantie deces
    const primeEmprunteur = tauxPrime * montant;
    document.getElementById('primeEmprunteur').innerText = primeEmprunteur.toFixed(2);

    // Calcul de la prime
    const prime = primeEmprunteur * (1 + tauxSurprime);
    
    // Résultat final
    
    const primeFinal = prime + yakoGuarantee + primeEmprunteur;


    document.getElementById('prime').innerText = prime.toFixed(2);
    document.getElementById('totalPremium').innerText = primeFinal.toFixed(2);


    // recuperation des data

    const data = {
        poidsCorrige: poidsCorrige,
        dateNaissance: dateNaissance,
        age: age,
        poids: poids,
        taille: taille,
        rpt: rpt,
        indiceSurmortalite: indiceSurmortalite,
        duree: duree,
        montant: montant,
        genre: genre,
        tauxPrime: tauxPrime,
        tauxSurprime: tauxSurprime,
        primeEmprunteur: primeEmprunteur,
        prime: prime,
        primeFinal: primeFinal,
        yakoGuarantee: yakoGuarantee,
        primeObseque: primeObseque,
    };


    fetch('/epret/store-simulation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(data),
    })
    .then(response => {
        if (response.ok) {
            console.log('Simulation data stored successfully');
        } else {
            console.error('Failed to store simulation data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
    

    // Affichage des données dans la console
    for (const key in data) {
        console.log(`${key}: ${data[key]}`);
    }


    // Résultat final
    document.getElementById("resultat").innerHTML = `

        <p>Poids corrigé: ${poidsCorrige} kg</p>
        <p>RPT: ${rpt}</p>
        <p>Surmortalité: ${indiceSurmortalite}%</p>
        <p>Garantie Décès : ${primeEmprunteur.toFixed(2)} Fcfa</p>
        <p>Garantie yako : ${yakoGuarantee.toFixed(2)} Fcfa</p>
        <p>Prime : ${prime.toFixed(2)} Fcfa</p>
        <p>Taux Surprime : ${(tauxSurprime * 100).toFixed(2)} %</p>
        <p>Prime totale : ${primeFinal.toFixed(2)} Fcfa</p>
    `;
});

   
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulletin individuel d'adhesion</title>
</head>
<body>
    <style>
        input {
            font-size: 20px;
            color: #000;
        }
        td {
            padding: 3px !important;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
        }

        body {
            font-family: Arial, sans-serif;
            padding-left: 35px;
            padding-right: 35px;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .chechbox {
            border: 1px solid black;
            color: #fff;
            max-width: 3px !important;
            max-height: 3px !important;
            font-size: 9px;
            margin-right: 5px;
        }
    </style>

    @php
        $dateNow = now();
        $formattedDate = $dateNow->format('m/Y');

        $primeTotal = $pret->primeobseque + $pret->primeemprunteur + $pret->prime
    @endphp


    <div class="a4-container" style=" width: 100%; margin: 0 auto">
        <section>
            <div class="container1_1 row" style="width: 100%; align-items: center">

             <div style="width: 25%; float: left; justify-content: start">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="width: 100px">
             </div>
             <div style="width: 50%; float: center; margin-left: 170px">
                <center>
                    <h2>BULLETIN INDIVIDUEL D'ADHESION</h2>
                    <H3 style="margin-top: 5px">DEMANDE INDIVIDUEL D'AFILIATION AU PRET</H3>

                    <div style="border: 1px solid black; text-align: center; padding: 5px; margin-top: 5px">
                        N° : YAAV-{{ $formattedDate }}-{{ $pret->id }}
                    </div>
                </center>
             </div>
             <div style="width: 25%; float: right; margin-right: -60px">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="width: 100px">
             </div>
    
            </div>
        </section>

        <section style="margin-top: 70px ">
            <div>
                Je soussigné NOM Complet demande mon affiliation à l'assurance en référence ety désigne comme bénéficiaire de ladite Assurance la CONTRACTANTE ci-après désigné : {{ Auth::user()->membre->nom }} {{ Auth::user()->membre->prenom}}
            </div>
             <div style="float: right; margin-top: -5px ">
                <strong>Conseiller :</strong> <span>{{ Auth::user()->membre->nom }} {{ Auth::user()->membre->prenom}}</span>
             </div>
        </section>

        <section>
            <div class="container">

                <div class="aderent" style="margin-top: 18px; border: 1px solid #ccc; background-color: #7471716e; height: 18px">
    
                    <h4 style="color: #000000; font-size: 13px; margin-left: 5px">1. ADHERENT / ASSURE(E) :</h4>
    
                </div>
    
                <div class="adherent" style="margin-top: 5px; width: 100%">

                    <div style="width: 50%; float: left;">
                        <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Civilité :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->civilite }}</span>
                        </div>

                        <div class="name" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Nom et Prénoms :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->nom }} {{ $pret->adherent->prenom }}</span>
                        </div>

                        <div class="bithday" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Né(e) le :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->datenaissance }}</span>
                        </div>

                        <div class="lieu" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>A :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->lieunaissance }}</span>
                        </div>
                        <div class="cni" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>N° CNI :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->numeropiece }}</span>
                        </div>
                    </div>

                    <div style="width: 50%; float: right;">
                        <div class="profession" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Profession :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->profession }}</span>
                        </div>

                        <div class="Mobile" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Mobile :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->mobile }}</span>
                        </div>

                        <div class="telephone" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Téléphone :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->telephone }}</span>
                        </div>

                        <div class="email" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Email :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->email }}</span>
                        </div>

                        <div class="adresse" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Adresse :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->lieuresidence }}</span>
                        </div>


                    </div>
                    
                    
                
                </div>
                
    
            </div>
        </section>
        <hr style="display:flex;margin-top: 105px; margin-bottom: -110px">

        <section style="margin-top: 120px">
            <div style="width: 100%">
                <div style="width: 40%; float: left;">
                    <div class="civilite" style="position: relatie; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolte; left: 0;"><strong>Type de pret :</strong></label>
                        <span style="position: absoute; right: 60;">{{ $pret->typepret }}</span>
                    </div>
                </div>
                <div style="width: 30%; float: left;">
                    <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Durée du pret (mois) :</strong></label>
                        <span style="position: absolute; right: 60;">{{ $pret->duree }}</span>
                    </div>
                </div>
                <div style="width: 30%; float: right;">
                    <div class="civilite" style="position: reltive; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absoute; left: 0;"><strong>Montant du pret (Fcfa) :</strong></label>
                        <span style="position: absolute;">{{ $pret->montantpret }}</span>
                    </div>
                </div>

            </div>
            <div style="width: 100%; margin-top: 25px;">
                <div style="width: 40%; float: left;">
                    <div class="civilite" style="position: relatie; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolte; left: 0;"><strong>Mise en place prévue le :</strong></label>
                        <span style="position: absoute; right: 60;">{{ $pret->effetgarantie }}</span>
                    </div>
                </div>
                <div style="width: 30%; float: left;">
                    <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Mise en effective :</strong></label>
                        <span style="position: absolute; right: 60;">----</span>
                    </div>
                </div>
                <div style="width: 30%; float: right;">
                    <div class="civilite" style="position: reltive; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absoute; left: 0;"><strong>Ref :</strong></label>
                        <span style="position: absolute;">------</span>
                    </div>
                </div>

            </div>
        </section>

        <div class="prime" style="margin-top: 22px; border: 1px solid #ccc; background-color: #7471716e; height: 18px">
    
            <h4 style="color: #000000; font-size: 13px; margin-left: 5px">2. PRIMES :</h4>

        </div>

        <section style="border: 1px solid #000; min-height: 40px; padding: 3px">
            
            <div class="prime" style="margin-top: 5px; width: 100%">

                <div style="width: 50%; float: left;">
                    <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 10px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Prime Emprunteur :</strong></label>
                        <span style="position: absolute; right: 60;">{{ $pret->primeemprunteur }}</span>
                    </div>

                    <div class="name" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 10px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Prime principale :</strong></label>
                        <span style="position: absolute; right: 60;">{{ number_format($pret->prime, 2, ',', '.') }}</span>
                    </div>

                    
                </div>

                <div style="width: 50%; float: right;">
                   @if ($pret->primeobseque != null)
                   <div class="lieu" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Prime YAKO :</strong></label>
                        <span style="position: absolute; right: 60;">{{ number_format($pret->primeobseque, 2, ',', '.') }}</span>
                    </div>
                   @endif
                    <div class="cni" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolute; left: 0;"><strong>PRIME TOTAL :</strong></label>
                        <span style="position: absolute; right: 60;">{{ number_format($primeTotal, 2, ',', '.') }}</span>
                    </div>

                    
                </div>
            </div>
        </section>

        <div class="questionnaire" style="margin-top: 10px; border: 1px solid #ccc; background-color: #7471716e; height: 18px">
    
            <h4 style="color: #000000; font-size: 13px; margin-left: 5px; text-transform: uppercase;">3. Questionnaire relatif à l'état de santé du proposant :</h4>

        </div>

        <section>
            <div class="container">
                <div class="question" style="margin-top: 5px; width: 100%">

                    <div style="width: 50%; float: left;">
                        <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Taile (Cm) :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->taille }}</span>
                        </div>

                        <div class="name" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Fumez-vous ? :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->fumezvous }} </span>
                        </div>

                        <div class="bithday" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Vos distractions :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->distraction }}</span>
                        </div>

                        <div class="lieu" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Pratiquez-vous une activité sportive ? :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->estsportif }}</span>
                        </div>
                    </div>

                    <div style="width: 50%; float: right;">
                        <div class="profession" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Etes-vous en arret de travail :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->estenarrettravail }}</span>
                        </div>

                        <div class="Mobile" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Poids :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->poids }}</span>
                        </div>

                        <div class="telephone" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Buvez-vous l'alcool :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->buvezvous }}</span>
                        </div>

                        <div class="email" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Tension arterielle :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->tension }}</span>
                        </div>


                    </div>
                    
                    
                
                </div>
                
    
            </div>
        </section>

        <section style="margin-top: 90px">
            <table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse; font-size: 14px; text-align: left;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="width: 10%;">#</th>
                        <th style="width: 70%;">Nature</th>
                        <th style="width: 20%;">Réponse</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 2px">1</td>
                        <td style="padding: 2px">Avez-vous déjà été victime d'un accident</td>
                        <td style="padding: 2px">{{ $pret->estinfirme }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Suivez-vous ou avez-vous suivi un traitement médical ces 6(six) derniers mois ?</td>
                        <td>--</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Avez-vous déjà subi une transfusion de sang ?</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Avez-vous déjà subi des interventions chirugicales ?</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Devez-vous déjà subi des interventions chirugicales ?</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Diabète</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Hypertension artérielle</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Drépanocytose</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Cirrhose de foie</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Affectations pulmonaires</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Cancer</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Anémie</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>Avez-vous déjà été victime d'un AVC ?</td>
                        <td>Non</td>
                    </tr>
                </tbody>
            </table>
            
        </section>

        <section style="margin-top: 10px">
            <div>
                Je certifie, avoir répondu avec exatitude et sincérité aux questions ci-dessus,n'avoir rien déclaré ou omis qui puisse induire en erreur YAKO AFRICA et reconnait etre informé des dispositions de l'article 18 du code des assurances CIMA sanctionnant toute réticence ou fausse déclaration. je déclare avoir pris connaissance des garanties offertes par le contrat souscrit par la contractante
            </div>
        </section>
        
        <section style="margin-top: 10px">
            <div class="identiteee" style="width: 100%">
                <div style="width: 48%; float: left; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">
                    <p>Fait à ............................................... le {{ $dateNow }}</p>
                    <div class="sign-yako" style="margin-top: 8px">

                        <span>Reservé à YAKO AFRICA Assurances Vie</span>
                        <div>
                            <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/Signature_Dta.jpg'))) }}" alt="Logo" style="width: 160px">
                        </div>
                    </div>

                </div>

                <div style="width: 48%; height: 125px; float: right; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">

                    <div class="nom">

                        <label for="nom">BON POUR AUTORISATION A L'ASSURANCE ADHERENT (signature précédée de la mention LU et APPROUVE)</label>

                    </div>

                </div>
            </div>
        </section>
        
        
    </div>


</body>
</html>
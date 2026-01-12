<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription PLAN GAGNANT</title>
</head>
<body>
    <style>
        input {
            font-size: 20px;
            color: #000;
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

    <div class="a4-container">
        <section>
            <div class="container1_1 row" style="width: 100%">

                <div class="logo col-4" style="width: 25%; float: left">
    
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="width: 100px">
    
                </div>
    
                <div style="width: 75%; font-size: 12px; font-weight: bold; text-align: center; background: #747171; color: #fff; height: 55px; display: flex; justify-content: center; align-items: center; float: right">
    
                    <center class="title" style="text-align: center; align-items: center; margin-top: 15px">
    
                        <h2 class="text-uppercase" style="font-size: 15px">FORMULAIRE DE SOUSCRIPTION {{ $contrat->libelleproduit ?? "" }}</h2>
    
                    </center>
    
                </div>
    
            </div>
        </section>

        <section style="margin-top: 50px !important">
            <div class="container">

                <div class="aderent" style="margin-top: 30px; border: 1px solid #ccc; background-color: #747171; height: 18px">
    
                    <h4 style="color: #fff; font-size: 13px; margin-left: 5px">1. ADHERENT :</h4>
    
                </div>
    
                <div class="content1" style="margin-top: 10px;">
    
                    <div class="sexe">
    
                        <p  style="font-size: 12px;">
                            <strong>Civilité :</strong> 
                            <span class="">{{ $contrat->adherent->civilite ?? 'Non renseigné' }}</span></span>
                        </p>
    
                    </div>
    
                    <div class="identite" style="margin-top: 10px">
    
                        <div class="cin" style="float: left">
    
                            <div class="nom">
    
                                <label for="nom"><strong>Nom :</strong> {{{ $contrat->adherent->nom ?? ''}}}</label>
    
                            </div>
    
                            <div class="prenom" style="margin-top: 10px">
                                <label for="prenom"><strong>Date de naissance :</strong>{{{ $contrat->adherent->datenaissance ?? ''}}}</label>
                            </div>
    
                        </div>
    
                        <div class="cin" style="float: right">
    
                            <div class="nom">
    
                                <label for="nom"><strong>Prenom :</strong> {{ $contrat->adherent->prenom ?? '' }}</label>
    
                            </div>
    
                            <div class="prenom" style="margin-top: 10px">
                                <label for="prenom"><strong>lieu de naissance :</strong> {{ $contrat->adherent->lieunaissance ?? '' }}</label>
                            </div>
    
                        </div>
    
                    </div>

                    <div class="Situation" style="margin-top: 47px">
    
                        <p  style="font-size: 12px;">
                            {{-- <span>Situation matrimoniale :</span> 
                            <span>Célibataire <span class="chechbox">aa</span></span>
                            <span>Marié (e) <span class="chechbox">aa</span></span>
                            <span>Veuve <span class="chechbox">aa</span></span> --}}
                        </p>
                    </div>

                    <div class="identite" style="margin-top: 12px">
    
                        <div class="cin" style="float: left">
    
                            <div class="nom">
                                <label for="nom"><strong>Profession :</strong> {{ $contrat->adherent->profession ?? '' }}</label>
                            </div>
    
                            <div class="prenom" style="margin-top: 10px">
                                <label for="prenom"><strong>Adresse complet :</strong> {{ $contrat->adherent->lieuresidence ?? '' }}</label>
                            </div>
                        </div>
    
                        <div class="cin" style="float: right">
    
                            <div class="nom">
    
                                <label for="nom"><strong>Lieu de residence :</strong> {{ $contrat->adherent->lieuresidence ?? '' }}</label>
    
                            </div>
    
                            <div class="prenom" style="margin-top: 10px">
    
                                <label for="prenom"><strong>Employeur :</strong> {{ $contrat->adherent->employeur ?? '' }}</label>
    
                            </div>
    
                        </div>
    
    
    
                    </div>
                    <div class="identite" style="margin-top: 50px">
    
                        <div class="" style="width: 100%">
    
                            <div class="nom" style="width: 100%">
    
                                <label for="nom" style="width: 31%"><strong>Telephone :</strong> {{ $contrat->adherent->telephone ?? '' }}</label>
    
                                <label for="nom" style="width: 31%"><strong>Telephone 2 :</strong> {{ $contrat->adherent->telephone1 ?? '' }}</label>
    
                                <label for="nom" style="width: 32%"><strong>N° Whatsapp :</strong> {{ $contrat->adherent->mobile ?? '' }}</label>
    
                                <label for="nom" style="width: 32%"><strong>E-mail :</strong> {{ $contrat->adherent->email ?? '' }}</label>
    
                            </div>
    
                            <div class="prenom" style="width: 100%; margin-top: 10px">
    
                                <label for="prenom" style="width: 70%"><strong>Personne à contacter en cas d'urgence :</strong> {{ $contrat->personneressource ?? '' }}</label>
    
                                <label for="prenom" style="width: 30%"><strong>N° Tel :</strong> {{ $contrat->contactpersonneressource ?? '' }}</label>
    
                            </div>
    
                        </div>
    
                    </div>
                </div>
    
            </div>
        </section>

        <section>

            <div class="aderent" style="margin-top: 30px; border: 1px solid #ccc; background-color: #747171; height: 18px">
    
                <h3 style="color: #fff; font-size: 13px; margin-left: 5px">2. BENEFICIAIRE :</h3>

            </div>
    
            <div class="content1">
    
                <div class="identiteee" style="width: 100%">
    
                    <div style="width: 48%; min-height: 60px; float: left; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">
                        <div class="terme" style="flex: 1;">
                            <u>Au terme du contrat</u>
                        </div>

                        <div class="prenom" style="flex: 1; width: 100%; text-align: left; margin-top: 10px; text-transform: capitalize">
                            {{ $contrat->beneficiaireauterme ?? '' }}
                        </div>
                
                    </div>
                
                    <div style="width: 48%; min-height: 60px; float: right; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">
                        <div class="terme" style=" flex: 1;">
                            <u>En cas de décès avant terme du contrat</u>
                        </div>
                
                        <div class="prenom" style="flex: 1; width: 100%; text-align: left; margin-top: 10px; text-transform: capitalize">
                            {{ $contrat->beneficiaireaudeces ?? '' }}
                        </div>
                
                        
                    </div>
                
                </div>
                
            </div>
        </section>

        <section style="margin-top: 60px ">
            <div class="container">

                <div class="aderent" style="margin-top: 30px; border: 1px solid #ccc; background-color: #747171; height: 18px">
    
                    <h4 style="color: #fff; font-size: 13px; margin-left: 5px">3. GARANTIE SOUSCRITES ET PRIMES :</h4>
    
                </div>

                <div style="display: inline-block; border: 1px solid #ccc; border-collapse: collapse; width: 100%;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">CONTRAT</td>
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">CAPITAL SOUSCRIT</td>
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">PRIME</td>
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">PERIODICITE</td>
                        </tr>
                        <tr style="background-color: #f2f2f2;">
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $contrat->libelleproduit ?? '' }}</td>
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $contrat->capital ?? '' }}</td>
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $contrat->prime ?? '' }}</td>
                            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $contrat->periodicite ?? '' }}   </td>
                        </tr>
                    </table>
                </div>
                
    
            </div>
        </section>

        <section>
            <div class="container">
                <div class="aderent" style="margin-top: 20px; border: 1px solid #ccc; background-color: #747171; height: 18px">
    
                    <h4 style="color: #fff; font-size: 13px; margin-left: 5px">4. PAIEMENT DE PRIME :</h4>
    
                </div>

                <div class="content" style="width: 100%;">
    
                    <div class="content-item" style="width: 48%; height: 80px; float: left; border: 1px solid #000; padding: 5px; box-sizing: border-box;">
                    
                        <div class="sexe">
    
                            <p  style="font-size: 12px;">
                                <strong>Mode de paiement :</strong> 
                                {{ $contrat->modepaiement ?? '' }}
                            </p>
                            <p style="box-sizing: border-box; margin-top: 20px">Reférence de paiement : </p> <br>
        
                        </div>
                    </div>
                    <div class="content-item" style="width: 48%; height: 80px; float: left; border: 1px solid #000; padding: 5px; box-sizing: border-box; float: right;">
    
                        <div class="content-item" style=" box-sizing: border-box;">
                            <p style="box-sizing: border-box;"> 
                                <span class="chechbox">aa</span> Chèque à l'ordre de YAKOA ASSURANCE VIE
                            </p>
    
                            <p style="margin-top: 20px; font-weight: bold">RIB : CI007 01030 039273900100 79</p>
                        </div>
                    </div>
    
                </div>
            </div>
        </section>

        <section style="margin-top: 100px">
            <div class="container" style=" width: 100%">

                <div class="cin" style="float: left; width: 49%">

                    <div class="nom" style="">

                        <label for="nom"><strong>Le contrat souscrit prend effet le :</strong> {{ $contrat->dateeffet ?? '' }}</label>

                    </div>

                </div>

                <div class="cin" style="float: right; width: 49% ">

                    <div class="nom">

                        <label for="nom"><strong>Pour une durée expirant le :</strong> {{ $contrat->duree ?? '' }}</label>

                    </div>
                </div>

            </div> 

            <div class="prenom" style="width: 100%; margin-top: 10px">

                <label for="prenom">Fait à : {{ $contrat->user->membre->zone->libellezone ?? '' }} le {{ \Carbon\Carbon::parse($contrat->saisiele)->format('d/m/Y à H:i:s') ?? '' }} </label>

            </div>
        </section>

        <section style="margin-top: 30px">
            <div class="identiteee" style="width: 100%">
                <div style="width: 48%; float: left; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">

                    <div class="sign-yako">

                        <span>Reservé à YAKO AFRICA Assurances Vie</span>
                        <div>
                            <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/Signature_Dta.jpg'))) }}" alt="Logo" style="width: 200px">
                        </div>
                    </div>

                </div>

                <div style="width: 48%; min-height: 127px; float: right; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">

                    <div class="nom">

                        <label for="nom"><strong>Nom du conseiller :</strong> {{ Auth::user()->membre->nom ?? ""}} {{ Auth::user()->membre->prenom ?? ""}}</label>

                        <br><br>

                        <label for="prenom">Signature du Souscripteur</label>
                        <div>
                            <img src="{{ $qrCodeBase64 }}" alt="QR Code de vérification" style="width: 60px; height: 60px;">
                        </div>
                        <div>
                            @if ($imageSrc != null)
                                <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 55px; height: 55px;">
                            @endif

                            {{-- <img src="{{ $qrCodeBase64 }}" alt="QR Code de vérification" style="width: 50px; height: 50px; border: 2px solid blue; background-color: #ff1515;"> --}}
                        </div>

                    </div>

                </div>
            </div>
        </section>

       

    </div>

</body>

</html>


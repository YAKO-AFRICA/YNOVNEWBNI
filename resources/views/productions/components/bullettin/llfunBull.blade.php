<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription Yako Obseque Diaspora</title>
</head>

<body>
    <style>
        input {
            font-size: 10px;
        }
    </style>

    <div class="container">

        <section>
            <div class="logo-Soutien" style="width: 100%; overflow: hidden;">

                <!-- Bloc gauche -->
                <div style="width: 22%; float: left; text-align: center;">
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="width: 100px;">
                </div>

                <!-- Bloc centre -->
                <div style="width: 56%; float: left; text-align: center;">
                    <div style="width: 100%; font-size: 10px; font-weight: bold; text-align: center; background: #747171; color: #fff; height: 50px; display: flex; justify-content: center; align-items: center;">
                        <h1 style="margin: 0;">FORMULAIRE DE SOUSCRIPTION YAKO OBSEQUE DIASPORA</h1>
                    </div>
                    <div style="width: 20%; font-size: 10px; font-weight: bold; text-align: center; display: flex; justify-content: center; align-items: center; border: 1px solid #747171;">
                        <strong style="margin: 0;">Option :</strong> <span style="margin: 0;">{{ $contrat->Formule ?? 'Individuel' }}</span>
                    </div>
                    <div style="width: 30%; font-size: 10px; font-weight: bold; text-align: center; display: flex; justify-content: end; align-items: center; float: right; margin-top : -25px;">
                        <span style="margin: 0;">Numero :</span> <span style="margin: 0;">{{ $contrat->numBullettin ?? '' }}</span>
                    </div>
                </div>

                <!-- Bloc droite -->
                <div style="width: 22%; float: left; text-align: center;">
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('logos/DIASPORA.jpg'))) }}" alt="Logo" style="width: 100px;">
                    
                </div>

                <div style="clear: both;"></div>
            </div>
        </section>


        <section style="margin-top: 10px; font-size: 12px; min-height: 100px">
            <div class="contentt" style="padding: 0; margin: 0">
                <h4 style="background: #747171; color: #fff; width: 100%; height: 25px; margin-bottom:0 ; font-size: 14px ; justify-content: center; align-items: center; display: flex">1. Informations de l'adherent / Assuré principal</h4>

                <div class="content-item" style="width: 49%; float: left; border: 1px solid #000; padding: 5px; font-size: 12px; box-sizing: border-box; min-height: 100px">
                    <div class="infoSouscripteur2" style="margin: 0; width: 100%; box-sizing: border-box; font-size: 12px">
                
                        <p style="margin: 5px;">
                            <strong>Nom et prénoms :</strong> <span>{{ $contrat->adherent->nom ?? ''}} {{ $contrat->adherent->prenom ?? ''}}</span>
                        </p>
                    
                        <p style="margin: 5px">
                            <strong>Date de naissance :</strong> {{ $contrat->adherent->datenaissance ?? ''}}     
                            <strong>Lieu :</strong> {{ $contrat->adherent->lieunaissance ?? ''}}
                        </p>
                    
                        <p style="margin: 5px">
                            <strong>Nationalité :</strong> ........................................ 
                        </p>
                        <p style="margin: 5px">
                            <strong>Sexe :</strong>  {{ $contrat->adherent->sexe ?? ''}}
                        </p>
                
                    </div>
                </div>

                <div class="content-item" style="width: 48%; float: left; border: 1px solid #000; padding: 5px; font-size: 12px; box-sizing: border-box; float: right; min-height: 100px">
                    <div class="infoSouscripteur2" style="margin: 0; width: 100%; box-sizing: border-box;">
                        
                        <p style="margin: 5px; display: flex; justify-content: space-between;">
                            <span><strong>Mobile :</strong> {{ $contrat->adherent->mobile ?? ''}}</span>
                            <span><strong>Téléphone2 :</strong> {{ $contrat->adherent->mobile1 ?? ''}}</span>
                        </p>
                         <p style="margin: 5px; display: flex; justify-content: space-between;">
                            <strong>N° Whasapp :</strong> {{ $contrat->adherent->telephone ?? '......................'}}
                            
                        </p>
                         <p style="margin: 5px; display: flex; justify-content: space-between;">
                            <strong>Email :</strong>{{ $contrat->adherent->email ?? ''}}
                            
                        </p>
                        <p style="margin: 5px; display: flex; justify-content: space-between;">
                            <strong>Adresse complète:</strong> <span class="">{{ $contrat->adherent->lieuresidence ?? ''}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section style="margin-top: 70px">
            <div class="content-item" style="width: 100%; border: 1px solid #000; font-size: 12px;">
                <h4 style="background: #747171; color: #fff; width: 100%; height: 25px; margin: 0; font-size: 14px;">2. Informations des assurés</h4>

                <table style="width: 100%; border-collapse: collapse; font-size: 12px; text-align: center; margin: 0">
                    <thead>
                        <tr>
                            <td style=" border: 1px solid #000; color: #000">NOM & PRÉNOMS</td>
                            <td style=" border: 1px solid #000; color: #000">DATE DE NAISSANCE</td>
                            <td style=" border: 1px solid #000; color: #000">LIEU DE NAISSANCE</td>
                            <td style=" border: 1px solid #000; color: #000" >TELEPHONE</td>
                            <td style=" border: 1px solid #000; color: #000">FILIATION</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contrat->assures as $assure)
                        <tr>
                            <td style="width: 50%; border: 1px solid #000;">{{ $assure->nom ?? '' }} {{ $assure->prenom ?? ''}}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $assure->datenaissance ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $assure->lieuresidence ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $assure->mobile ?? $assure->telephone ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $assure->filiation ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </section>
        <section style="margin-top: 15px">
            <div class="content-item" style="width: 100%; border: 1px solid #000; font-size: 12px;">
                <h4 style="background: #747171; color: #fff; width: 100%; height: 25px; margin: 0; font-size: 14px;">4. Informations des beneficiaires</h4>

                <table style="width: 100%; border-collapse: collapse; font-size: 12px; text-align: center; margin: 0">
                    <thead>
                        <tr>
                            <td style=" border: 1px solid #000; color: #000">NOM & PRÉNOMS</td>
                            <td style=" border: 1px solid #000; color: #000">DATE DE NAISSANCE</td>
                            <td style=" border: 1px solid #000; color: #000">LIEU DE NAISSANCE</td>
                            <td style=" border: 1px solid #000; color: #000" >TELEPHONE</td>
                            <td style=" border: 1px solid #000; color: #000" >EMAIL</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contrat->beneficiaires as $benef)
                        <tr>
                            <td style="width: 50%; border: 1px solid #000;">{{ $benef->nom ?? '' }} {{ $benef->prenom ?? ''}}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $benef->datenaissance ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $benef->lieuresidence ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $benef->mobile ?? $benef->telephone ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $benef->email ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </section>
        <section style="margin-top: 15px">
            <div class="content-item" style="width: 100%; border: 1px solid #000; font-size: 12px;">
                <h4 style="background: #747171; color: #fff; width: 100%; height: 25px; margin: 0; font-size: 14px;">3. Couverture souhaitée</h4>

                <table style="width: 100%; border-collapse: collapse; font-size: 12px; text-align: center; margin: 0">
                    <thead>
                        <tr>
                            <td style=" border: 1px solid #000;">Choix Capital</td>
                            <td style=" border: 1px solid #000;">Prime de base</td>
                            <td style=" border: 1px solid #000;">Surprime</td>
                            <td style=" border: 1px solid #000; font-weight: bold; text-align: right;">Total</td>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 50%; border: 1px solid #000;">{{ $contrat->capital ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $contrat->primepricipale ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $contrat->surprime ?? '' }}</td>
                            <td style="width: 50%; border: 1px solid #000;">{{ $contrat->primepricipale ?? '' }}</td>
                        </tr>
                    </tbody>
                    
                </table>
                

                <div style="width: 100%;font-size: 12px; padding: 2px; margin-top: 10px; height: 20px">
                    <div style ="width: 30%; float: left;  margin-top: -10px"><strong>Durée de la couverture</strong> <span>{{ $contrat->duree ?? '' }}</span></div>
                    <div style ="width: 30%;float: center; margin-left: 200px; margin-top: -10px">
                        <strong>Date de debut du contrat</strong> 
                        <span>{{ Carbon\Carbon::parse($contrat->dateeffet)->format('d/m/Y') ?? '' }}</span>
                    </div>
                    <div style ="width: 30%; float: right; margin-top: -10px"><strong>Durée du contrat :</strong> <span>Annuel</span></div>
            
                </div>
            </div>
        </section>

        

        <section style="font-size: 12px !important">

            <h4 style="background: #747171; color: #fff; width: 100%; height: 25px; margin-top: 40px; font-size: 14px">5. Paiement des primes :</h4>
            
            <div class="content" style="width: 100%; margin-top: -15px">

                <div class="content-item" style="width: 48%; height: 15px; float: left; border: 1px solid #000; padding: 5px; font-size: 12px; box-sizing: border-box;">
                <div class="infoSouscripteur2" style="margin: 0; width: 100%; box-sizing: border-box;"> 
                    <strong style="box-sizing: border-box; margin-top:-10px; font-size: 12px">
                        Mode de paiement : 
                        @if(isset($contrat->modepaiement))
                            @if($contrat->modepaiement == 'VIR')
                                Virement bancaire
                            @elseif($contrat->modepaiement == 'ESP')
                                Espèces
                            @elseif($contrat->modepaiement == 'SOURCE')
                                Prélèvement à la source
                            @elseif($contrat->modepaiement == 'CHK')
                                Paiement par chèque
                            @elseif($contrat->modepaiement == 'Mobile_money')
                                Mobile money
                            @else
                                {{ $contrat->modepaiement }}
                            @endif
                        @endif
                    </strong>
                </div>

            </div>
                <div class="content-item" style="width: 48%; height: 15px; float: left; border: 1px solid #000; padding: 5px; font-size: 12px; box-sizing: border-box; float: right;">

                    <div class="content-item" style="margin-top: -15px; box-sizing: border-box;">
                        <p style="box-sizing: border-box;">
                            <strong>conseiller : </strong> <span>{{ Auth::user()->membre->nom ?? $contrat->nomagent ?? '' }} {{ Auth::user()->membre->prenom ?? ''}}<span> <strong>Code :</strong> <span>{{ Auth::user()->membre->codeagent ?? $contrat->codeConseiller ?? ''}}</span>
                        </p>
                    
                        {{-- <p style="box-sizing: border-box;">
                            
                        </p> --}}
                    </div>
                </div>

            </div>

        </section>

        <p style="box-sizing: border-box; margin-bottom: 0; margin-top: -15px">
            Fait le {{ Carbon\Carbon::parse($contrat->saisiele)->format('d/m/Y') ?? '................................................' }}
        </p>

        <section style="font-size: 12px !important; box-sizing: border-box; margin-top: 20px ; width: 100%">

            <div class="row" style="
                display: flex;
                justify-content: space-between;
                padding: 1rem;
                box-sizing: border-box;
                width: 100%;
                gap: 1rem; 
                font-size: 12px;">

                <div style="width: 33%; float: left; min-height: 160px ; border: 1px solid #000; padding: 2px">
                    <strong>
                        Signature du souscripteur
                    </strong> <br>
                    <span style="font-size: 10px">
                        Je soussigné(e),................................................., <br> certifie que les informations fournies sont exactes. <br> Je consens au traitement de mes données personnelles par YAKO AFRICA ASSURANCE VIE dans le cadre de cette souscription.
                    </span>
                    <div style="disply: flex; justify-content: space-between; margin-top: 10px;">
                        <div style="width: 48%; float: left">
                            <img src="{{ $qrCodeBase64 }}" alt="QR Code de vérification" style="width: 60px; height: 60px;">
                        </div>
                        <div style="width: 48%; float: right">
                            @if (!empty($imageSrc))
                                <img src="{{ $imageSrc }}" alt="Signature" style="width: 55px; height: 55px;">
                            @endif
                        </div>
                    </div>
                </div>
                <div style="width: 30%; margin-left: 240px ; min-height: 160px; border: 1px solid #000; padding: 2px">
                    <strong>
                        Signature de l'assuré
                    </strong>

                    <muted>(Précedée de la mention LU et APPROUVE)</muted>
                </div>
                <div style="width: 33%; float: right; margin-top: -165px; min-height: 160px; border: 1px solid #000; padding: 2px">
                    <div class="sign-yako" style="margin: 0; box-sizing: border-box ">
                        <span>Reservé à YAKO AFRICA Assurances Vie</span>

                        <div>
                            <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/Signature_Dta.jpg'))) }}" alt="Logo" style="width: 200px">
                        </div>

                    </div>
                </div>
            </div>

            
        </section> 


    </div>
  
</body>

</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription Doihoo</title>
    <style>
        /* input {
            font-size: 20px;
            color: #000;
        } */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
            color: #444444
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

        .radio {
            margin-right: 10px;
            transform: scale(2.1);
        }

        .radio1 {
            margin-right: 10px;
            transform: scale(1.5);
        }

        .input-border-bottom {
            border: none;
            border-bottom: solid 1px;
        }

        .a4-container {
            width: 100%;
            height: 1050px;
            border-left: solid 15px #368257;
            padding: 5px
        }
        .padding{
            padding: 2px;
        }
    </style>
</head>

<body>
    <div class="a4-container">
        <section style="height: 65px">
            <div class="container1_1 row" style="width: 100%">

                <div class="logo col-4" style="width: 25%; float: left">

                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}"
                        alt="Logo" style="width: 100px">

                </div>
                <div
                    style="width: 45%; font-size: 12px; font-weight: bold; height: 25px; display: flex; justify-content: center; align-items: center; float: right">
                    <h2
                        style="font-size: 12px; float: right; display: flex; flex-direction: column; justify-content: center; align-items: center">
                        </h2>
                </div>

            </div>
        </section>
        <section style="margin-top: 10px">
            <div>
                <CENTER>
                    <h1><i style="font-size: 25px">BULLETIN DE SOUSCRIPTION</i></h1>
                </CENTER>
            </div>
        </section>
        <section style="height: 40px; margin-top: 15px; width: 100%">
            <div style="width: 50%; float: left;">
                <div style="width: 55%; margin: auto; border: 1px solid #444; padding: 7px; border-radius: 7px;">
                    <strong style="font-size: 15px">N° BULLETIN :</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                        style="color: red; font-size: 20px">{{ $contrat->numBullettin}}</span></div>
            </div>
            <div style="width: 50%; float: right;">
                <div style="width: 55%; margin: auto; border: 1px solid #444; padding: 7px; border-radius: 7px;">
                    <strong style="font-size: 15px">N° ID :</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                        style="color: red; font-size: 20px">{{ $contrat->id}}</span></div>
            </div>
            <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
        </section>
        <section style="margin-top: 20px; margin-bottom: 0px; padding: 5px; font-family: Arial, sans-serif;">
            <div class="container-fluid">

                <!-- Contenu -->
                <div class="content1" style="margin-top: 0px; padding: 5px;">
                    <h1 style="text-align: center; font-size: 100px; color: #368257; line-height: 0.8">Doiho<span style="color: #F8B133; font-size: 150px">o</span></h1>
                    <p style="text-align: center; font-size: 38px; color: #368257; line-height: 0.8; text-transform: uppercase">épargne à tirage</p>
                </div>

            </div>
        </section>
        <section style="margin-top: 20px; margin-bottom: 25px; padding: 15px; margin: 0 auto">
            <div style="margin-top: 15px; text-align: justify; background-color: #444444b3; padding: 10px; border-radius: 5px">
                <p style="color: #fff">Cet encadré a pour objectif d'attirer l'attention du souscripteur sur certaines dispositions éssentielles de la proposition d'assurance. Il est important que le souscripteur lise intégralement la proposition d'assurance, et pose les questions qu'il estime nécessaires avant de signer la contrat.</p>
            </div>
            <div style="clear: both;"></div> <!-- Pour,eviter les problèmes d'affichage -->
        </section>
        <section style="margin-top: 0px; margin-bottom: 25px; padding: 5px; borde: 1px solid #444;">
            <div style="padding: 4px; border: 1px solid #444; border-radius: 10px">
                <div style="margin: 0 auto; border: 1px solid #444; background-color: #dbdbdb22; padding: 20px 50px; border-radius: 10px">
                    <ol style="text-align: justify">
                        <li>Le contrat <strong>DOIHOO</strong> est un contrat d'assurance vie individuel.</li><br>
                        <li>Le contrat <strong>DOIHOO</strong> offre deux(2) garanties dénommées "<strong>INVEST</strong>" et "<strong>DOIHOO</strong>" : <br><br>
                            <ul style="text-align: justify; margin-left: 20px">
                                <li>La Garantie <strong>INVEST</strong> donne droit à une prestation égale à l'épargne constituée (Provision Mathématique).</li>
                                <li>La Garantie <strong>DOIHOO</strong> permet au Souscripteur de bénéficier par anticipation, à l'occasion d'un tirage au sort, d'une prestation égale à 20% du capital à terme.</li>
                            </ul><br>
                            <p>Le capital garanti dans le contrat <strong>DOIHOO</strong> est payable en une seule fois (montant unique)</p>
                        </li>
                        <br>
                        <li>Au terme du contrat, le capital est payé dans les <strong>QUINZE (15) JOURS</strong> suivant la remise de toutes les pièces prévues au contrat.</li>
                        <br>
                        <li>Chaque année, la participation aux bénéfices est déterminée à partir de moins de 90% des resultats techniques et 85% des resultats financiers, conformement aux dispositions des articles 82, 83 et 84 du code CIMA et virée au compte "Provision pour la participation aux bénéfices". Les provisions constituées sont repartis aux assurés, après approbation du Conseil d'Administration de l'assureur.</li>
                        <br>
                        <li>
                            Le contrat <strong>DOIHOO</strong> prévoit une faculté de rachat lorsque deux (2) primes annuelles au moins ou 15% de l'ensemble des primes prévues au contrat ont été payées. <br>
                            Les sommes demendées dans le cas des rachats sont versées par <strong>YAKO AFRICA</strong> dans un délai de <strong>SOIXANTE (60) JOURS</strong> suivant la date réception de la demande de rachat. <br>
                            Les valeurs de rachat au terme de chacune des huit (8) premières années au moins ainsi que la somme des primes versées au terme de chacune des même années sont indiquées sur les conditions particulières du contrat. Le <strong>DOIHOO</strong> prévoit également des avances le montant ne saurait dépasser 75% de la provision constituée.<br>
                        </li>
                        <br>
                        <li>
                            Les Chargements prélevés au contrat sont : <br><br>
                            <ul style="text-align: justify; margin-left: 20px">
                                <li>Chargement d'acquisition : 35% de la première prime annuelle en couverture de la garantie <strong>INVEST</strong>.</li>
                                <li>Chargement d'administration et de gestion sur la garantie <strong>INVEST</strong> : 7% de chaque prime.</li>
                                <li>Chargement d'administration et de gestion sur la garantie <strong>DOIHOO</strong> : 25% de chaque prime.</li>
                                <li>Chargement exceptionnel : 1.5% de chaque prime.</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
    </div>
    <div class="a4-container">
        <section style="margin-bottom: 25px; font-family: Arial, sans-serif; ">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">I</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">SOUSCRIPTEUR</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
               
                <section style="width: 30%; margin: 5px 0; border: 1px solid #444; padding: 5px; border-radius: 7px">
                    <div style="width: 100%; text-align: center;">
                        <div style="width: 33%; float: left;">
                            <input type="radio" class="radio1" name="civilite" 
                                   @if(isset($contrat->adherent->civilite) && strtolower($contrat->adherent->civilite) === 'madame') checked @endif>
                            <span>Mme</span>
                        </div>
                        <div style="width: 33%; float: left;">
                            <input type="radio" class="radio1" name="civilite" 
                                   @if(isset($contrat->adherent->civilite) && strtolower($contrat->adherent->civilite) === 'mademoiselle') checked @endif>
                            <span>Mlle</span>
                        </div>
                        <div style="width: 33%; float: left;">
                            <input type="radio" class="radio1" name="civilite" 
                                   @if(isset($contrat->adherent->civilite) && strtolower($contrat->adherent->civilite) === 'monsieur') checked @endif>
                            <span>M</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </section>
                <section style="width: 100%; margin: 5px 0; padding: 7px; border-radius: 7px;">
                    <div style="width: 100%;">
                        <!-- Passeport -->
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" name="naturepiece" 
                                   @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'passport') checked @endif>
                            <span>Passeport</span>
                        </div>
                        
                        <!-- CNI -->
                        <div style="width: 12%; float: left;">
                            <input type="radio" class="radio1" name="naturepiece" 
                                   @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'cni') checked @endif>
                            <span>CNI</span>
                        </div>
                        
                        <!-- AT (Permis de Conduire) -->
                        <div style="width: 10%; float: left;">
                            <input type="radio" class="radio1" name="naturepiece" 
                                   @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'at') checked @endif>
                            <span>AT</span>
                        </div>
                        
                        <!-- CC (Carte Consulaire) -->
                        <div style="width: 10%; float: left;">
                            <input type="radio" class="radio1" name="naturepiece" 
                                   @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'cc') checked @endif>
                            <span>CC</span>
                        </div>
                        
                        <!-- Numéro de pièce -->
                        <div style="width: 50%; float: left;">
                            <span>N°</span> 
                            <input type="text" style="width: 90%; padding: 2px;" 
                                   value="{{ $contrat->adherent->numeropiece ?? '' }}">
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </section>
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 10px;">
                    <div style="width: 50%; float: left;">
                        <label><strong>Nom : </strong><span>{{ $contrat->adherent->nom ?? '....' }}</span></label>
                    </div>
                    {{-- &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; --}}
                    <div style="width: 50%; float: right;">
                        <label><strong>Prénoms : </strong><span>{{ $contrat->adherent->prenom ?? '....' }}</span></label>
                    </div>
                </div>
                <div style="width: 100%; margin-top: 25px;">
                    <div style="width: 50%; float: left;">
                        <label><strong>Né(e) le :
                        </strong><span>{{ $contrat->adherent->datenaissance ?? '....' }}</span></label>
                    </div>
                    <div style="width: 50%; float: left;">
                        <label><strong>à
                        </strong><span>{{ $contrat->adherent->lieunaissance ?? '....' }}</span></label>
                    </div>
                    
                </div>

                <section style="width: 80%; margin-top: 30px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 45%; float: left;"><strong>Situation Matrimoniale :</strong></div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'CELIB') checked @endif>
                            <span>Célibataire</span>
                        </div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'MARIE') checked @endif>
                            <span>Marié(e)</span>
                        </div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'DIVOR') checked @endif>
                            <span>Divorcé(e)</span>
                        </div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'VEUVE') checked @endif>
                            <span>Veuf(ve)</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </section>

                <div style="width: 100%; margin-top: 15px;">
                     <div style="width: 50%; float: left;">
                        <label><strong>Profession :
                        </strong><span>{{ $contrat->adherent->profession ?? '....' }}</span></label>
                    </div>
                    <div style="width: 50%; float: right;">
                        <label><strong>Employeur :
                        </strong><span>{{ $contrat->adherent->employeur ?? '....' }}</span></label>
                    </div>
                </div>
                <div style="width: 100%; margin-top: 25px;">
                    <div style="width: 50%; float: left;">
                        <label><strong>Adresse :
                        </strong><span>{{ $contrat->adherent->telephone1 ?? '....' }}</span></label>
                    </div>
                    <div style="width: 50%; float: left;">
                        <label><strong>E-mail :
                        </strong><span>{{ $contrat->adherent->email ?? '....' }}</span></label>
                    </div>
                </div>
                <div style="width: 100% ; margin-top: 25px;">
                    <div style="width: 33%; float: left;">
                        <label><strong>Lieu de residence :
                        </strong><span>{{ $contrat->adherent->lieuresidence ?? '....' }}</span></label>
                    </div>
                    <div style="width: 33%; float: left;">
                        <label><strong>Téléphone courant :
                        </strong><span>{{ $contrat->adherent->mobile ?? '....' }}</span></label>
                    </div>
                    <div style="width: 33%; float: right;">
                         <label><strong>N° Whatsapp :
                        </strong><span>{{ $contrat->adherent->telephone ?? '....' }}</span></label>
                    </div>
                </div>
                
            </div>
        </section>
        <section style="margin-bottom: 25px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">II</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">GARANTIE</h4>
            </div>
            <!-- Contenu -->
            <div class="content1" style="margin-top: 5px; padding: 10px;">

                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    @foreach ($contrat->garanties as $garantie )
                    <tr>
                        <td class="padding">{{ $garantie->monlibelle ?? '' }}</td>
                        <td class="padding">{{ $garantie->prime ?? '' }}</td> 
                    </tr>
                    @endforeach
                    
                    {{-- <tr>
                        <td class="padding">Montant du capital garanti au terme du contrat</td>
                        <td class="padding">1 000 000</td> 
                    </tr>
                    <tr>
                        <td class="padding">Montant du capital garanti en cas de tirage au sort</td>
                        <td class="padding">200 000</td> 
                    </tr> --}}
                </table>
                
            </div>
            <div style="width: 100%;">
                <div class="div float-left col-4" style="width: 30%; float: left">

                    <strong>Durée : <i>{{ $contrat->duree ?? '' }} ans</i></strong>
                </div>
                <div class="div float-right col-4" style="width: 30% ; float: left">

                    <strong>Frais d'adhesions : <i>{{ $contrat->fraisadhesion ?? "7 500" }}</i> FCFA</strong>
                </div>
                <div class="div float-right col-4" style="width: 30% ; float: right">

                    <strong>Date d'effet : <i>{{ $contrat->dateeffet ?? '' }}</i></strong>
                </div>
            </div>
        
        </section>
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">III</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">PAIEMENT DES PRIMES</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                
                <div style="width: 100%; margin-top: 10px;">
                    <!-- Prélèvement bancaire (VIR) -->
                    <label style="margin-top: 0px; margin-left:20px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat" 
                               @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'VIR') checked @endif>
                        Prélèvement bancaire sur mon compte (<small><i>Joindre l'attestation de prélèvement et un relevé d'identité bancaire</i></small>)
                    </label>
                    
                    <!-- Retenue sur salaire (SOURCE) -->
                    <label style="margin-top: 5px; margin-left:20px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                               @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'SOURCE') checked @endif>
                        Retenue sur salaire auprès de mon employeur (<small><i>Joindre l'autorisation de retenue à la source</i></small>)
                    </label>
                    
                    <!-- Chèque (CHK) -->
                    <label style="margin-top: 5px; margin-left:20px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                               @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'CHK') checked @endif>
                        Chèque (<small><i>à l'ordre exclusif de <strong>YAKO AFRICA Assurances Vie</strong></i></small>)
                    </label>
                    
                    <!-- Espèces (ESP) -->
                    <label style="margin-top: 5px; margin-left:20px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                               @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'ESP') checked @endif>
                        Espèces (<small><i>exclusivement aux guichets de <strong>YAKO AFRICA Assurances Vie</strong> ou auprès des mandataires autorisés</i></small>)
                    </label>
                    
                    <!-- Mobile money (Mobile_money) -->
                    <label style="margin-top: 5px; margin-left:20px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                               @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'Mobile_money') checked @endif>
                        Mobile money ou Internet
                    </label>
                    
                    <!-- Autres (autres valeurs) -->
                    <label style="margin-top: 5px; margin-left:20px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                               @if(isset($contrat->modepaiement) && !in_array($contrat->modepaiement, ['VIR', 'SOURCE', 'CHK', 'ESP', 'Mobile_money'])) checked @endif>
                        Autres, préciser : &nbsp; 
                        <b>
                            @if(isset($contrat->modepaiement) && !in_array($contrat->modepaiement, ['VIR', 'SOURCE', 'CHK', 'ESP', 'Mobile_money']))
                                {{ $contrat->modepaiement }}
                            @else
                                ...............................................................................................................................................
                            @endif
                        </b>
                    </label>              
                </div>
                
            </div>
        </section>

        <section style="margin-bottom: 25px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">IV</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">BENEFICIAIRES</h4>
            </div>
            <!-- Contenu -->
            <div class="content1" style="margin-top: 5px; padding: 10px;">

                <div style="width: 15%; background-color: #7471718b; padding: 5px; margin: 10px 0; border-radius: 15px; text-align: center">
                    <strong><i>1. En cas de vie</i></strong></div>
                    <div style="width: 43%; float: left;"><input type="radio" checked class="radio1"><span>Le Souscripteur</span></div>
            </div>

            <div class="content1" style="margin-top: 5px; padding: 5px;">

                <div
                    style="width: 16%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                    <strong><i>2. En cas de décès</i></strong></div>
                <section style="width: 97%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 43%; float: left;">
                            <input type="radio" class="radio1" @if(isset($contrat->beneficiaireaudeces) && $contrat->beneficiaireaudeces == 'Conjoint') checked @endif>
                            <span>Le Conjoint non séparé de corps, ni divorcé</span>
                        </div>
                        <div style="width: 33%; float: left;">
                            <input type="radio" class="radio1" @if(isset($contrat->beneficiaireaudeces) && $contrat->beneficiaireaudeces == 'Enfants nés et à naitre') checked @endif>
                            <span>Les enfants nés et à naître</span></div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if(isset($contrat->beneficiaireaudeces) && $contrat->beneficiaireaudeces == 'autre') checked @endif>
                                <span>Autres</span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom complet</th>
                        <th>filliation</th>
                        <th>Né(e) le</th>
                        <th>Téléphone</th>
                        <th>Résidence</th>
                    </tr>
                    @foreach ($contrat->beneficiaires as $item)
                    <tr>
                        <td>{{ $item->nom ?? '' }} {{ $item->prenom ?? '' }}</td>
                        <td>{{ $item->filiation ?? '' }}</td>
                        <td>{{ $item->datenaissance ?? '' }}</td>
                        <td>{{ $item->mobile ?? '' }}</td>
                        <td>{{ $item->lieuresidence ?? '' }}</td>
                    </tr>
                    @endforeach
                    
                </table>

            </div>
        </section>
        <section style="margin-bottom: 70px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">V</h4>
            </div>
            <div class=""
                style="width: 35%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">FRAIS UNIQUE D'ADHESION</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <label><span>Frais unique d'Adhésion : </span><b>{{ $contrat->fraisadhesion ?? ''}} </b></label> <br><br>
                <section style="width: 90%; border-radius: 7px; margin-bottom: 7px;">
                    <div style="width: 100%;">
                        <div style="width: 38%; float: left;"><span>Adhésion aux services en ligne Y-Nov : </span></div>
                        <div style="width: 35%; float: left;"><input type="radio"
                                class="radio1"><strong>Abonnement mensuel: 500 FCFA</strong></div>
                        <div style="width: 35%; float: left;"><input type="radio"
                                class="radio1"><strong>Abonnement annuelle: 6000 FCFA</strong></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
            </div>
        </section>
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VI</h4>
            </div>
            <div class=""
                style="width: 65%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">PROTECTION DES DONNEES À CARACTERE PERSONNEL</h4>
            </div>
            <section style="margin-top: 10px; margin-bottom: 15px; padding: 5px; borde: 1px solid #444;">
                <div style="padding: 4px; border: 1px solid #444;  background-color: #dbdbdb22; border-radius: 10px">
                    <div style="margin: 0 auto; padding: 10px 50px; border-radius: 10px">
                        
                        <ol style="text-align: justify">
                            <li>Les informations collectées sur ce bulletin feront l'objet d'un traitement destiné à établir et gérer exclusivement le contrat <strong>DOIHOO</strong>.</li><br>
                            <li>Ces données seront conservées pour une duree de 10 années après l'échéance du contrat, nécessaires au respect des délais de participation. Les destinataires de ces données sont les services de <strong>YAKO AFRICA</strong>.</li>
                            <br>
                            <li>Conformement à la loi N° 2013-450 du 19 Juin 2013, vous bénéficiez d'un droit d'accès et de rectification des informations qui vous concernent.</li>
                            <br>
                            <li>Si vous souhaitez exercer ce droit et obtenir une communication des informations vous concernant, veuillez adresser un courrier à dpo@yakoafricassur.com accompagné de tout moyen permettant d'établir l'identité de la personne.</li><br>
                            <li>En signant dans la rubrique, signature, vous consentez de façon expresse et éclairée aux traitement de vos données par les services consernés.</li>
                        </ol>
                    </div>
                </div>
            </section>
        </section>

        <section style="margin-bottom: 30px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VII</h4>
            </div>
            <div class=""
                style="width: 65%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">Partie reservée à YAKO AFRICA</h4>
            </div>
            
            <section style="margin-top: 30px; margin-bottom: 20px; padding: 5px; font-family: Arial, sans-serif;">
                <div class="container-fluid">
    
                    <!-- Contenu -->
                    <div class="content1" style="margin-top: 0px; padding: 5px; border: 1px solid #444; border-radius: 7px; background-color: #dbdbdb22">
    
                        <!-- Colonne gauche -->
                        <div style="width: 54%; float: left; padding: 7px 5px;">
                            <div class="nom" style="margin-bottom: 10px;">
                                <label><strong>Conseiller : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="{{ $contrat->nomagent ?? ''}}"> </label>
                            </div>
    
                            <div class="birthday" style="margin-bottom: 10px;">
                                <label><strong>Unit Manager : </strong><input type="text" class="input-border-bottom"
                                        style="width: 76%" value="----"> </label>
                            </div>
    
                            <div class="prenom" style="margin-bottom: 10px;">
                                <label><strong>Assistant Manager : </strong><input type="text" class="input-border-bottom"
                                        style="width: 67%" value="----"> </label>
                            </div>
    
                            <div class="domicile" style="margin-bottom: 10px;">
                                <label><strong>Manager : </strong><input type="text" class="input-border-bottom"
                                        style="width: 83%" value="----"> </label>
                            </div>
    
                            <div class="profession" style="margin-bottom: 10px;">
                                <label><strong>Réseau : </strong><input type="text" class="input-border-bottom"
                                        style="width: 85%" value="{{ $contrat->agenceData->libelle ?? "" }}"> </label>
                            </div>
                        </div>
    
                        <!-- Colonne droite -->
                        <div style="width: 42%; float: right; padding: 7px 0px;">
                            <div class="nom" style="margin-bottom: 10px;">
                                <label><strong>Code : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="{{ $contrat->codeConseiller ?? "" }}"> </label>
                            </div>
    
                            <div class="prenom" style="margin-bottom: 10px;">
                                <label><strong>Code : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="----"> </label>
                            </div>
    
                            <div class="birthday" style="margin-bottom: 10px;">
                                <label><strong>Code : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="----"> </label>
                            </div>
    
                            <div class="domicile" style="margin-bottom: 10px;">
                                <label><strong>code : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="----"> </label>
                            </div>
                        </div>
    
                        <!-- Clear pour éviter les flottements -->
                        <div style="clear: both;"></div>
    
                    </div>
    
                </div>
            </section>

        </section>
        <div style="width: 33%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
            <strong><i>personne à contacter en cas d'urgence</i></strong>
        </div>
        <div style="width: 100%; margin: 15px 0; ">
            <label><strong>Nom et prénoms :
                </strong><span>{{ $contrat->personneressource ?? '....' }}</span></label>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            <label><strong>Contact :
                </strong><span>{{ $contrat->contactpersonneressource ?? '....' }}</span></label>
        </div>
        <section style="width: 100%; margin-top: 20px;">
            <div style="width: 100%; margin-top: 10px; margin-bottom: 20px;">
                <label>Fait à : <strong> {{ $contrat->user->membre->zone->libellezone ?? '' }}  </strong> le <strong> {{ \Carbon\Carbon::parse($contrat->saisiele)->format('d/m/Y à H:i:s') ?? '' }} </strong></label>
                
            </div>
            <div style="width: 100%; text-align: center;">
                <div style="width: 45%; float: left;">
                    <strong>Signature du souscripteur</strong>
                    {{-- <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p> --}}
                    <div>
                        @if ($imageSrc != null)
                            <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 55px; height: 55px;">
                        @endif
                    </div>

                    <img src="{{ $qrCodeBase64 }}" alt="QR Code de vérification" style="width: 60px; height: 60px;">
                </div>
                <div style="width: 45%; float: left;">
                    <strong>Signature de l'Assuré</strong>
                    <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p>
                </div> 
            </div>
            <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
        </section>

        <section style="border-bottom: 3px solid #ccc; margin-top: 40px">
            <div style="width: 100%;">
                <div style="float: left;"><small style="font-size: 10px">Produit conçu et testé par la cellule Recherche
                        & Développement de YAKO AFRICA Assurances Vie</small></div>
            </div>
            <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
        </section>
        <section style="padding: 0 25px; margin: 0 auto; margin-bottom: 20px">
            <div style="width: 100%; margin-bottom: 15px; margin-top: 5px">
                <div style="float: left; text-align:center;">
                    <p>
                        <small>
                            Société Anonyme d'Assurance Vie au capital de 3 000 000 000 FCFA. Entreprise régie par le
                            code des Assurances CIMA Siège social : Abidjan-Plateau - Immeuble woodin Center 4ème étage
                            - Avenue Noguès 01 BP 11885 Abidjan 01
                        </small>
                    </p>
                    <p>
                        <small><strong>Tél.: (225) 27 20 22 94 64 / 27 20 33 15 00 - Fax : (225) 27 20 22 95 92 - RCC :
                                CI-ABJ-03-2022-M-22882 </strong></small>
                    </p>
                    <p>
                        <small style="color: #656565">Email : infos@yakoafricassur.com - Site Web :
                            www.yakoafricassur.com</small>
                    </p>
                </div>
            </div>
        </section>


    </div>
</body>

</html>

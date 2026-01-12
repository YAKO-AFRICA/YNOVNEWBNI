<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription PERFORMA INDIVIDUEL</title>
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
                        MEF/DGTCP/DA/N°0200 du {{ $contrat->saisiele ?? "" }}</h2>
                </div>

            </div>
        </section>
        <section style="margin-top: 10px">
            <div>
                <CENTER>
                    <h1 style="font-size: 45px">Bulletin d'Adhésion</h1>
                </CENTER>
            </div>
        </section>
        <section style="height: 50px; margin-top: 15px; border-bottom: 7px solid #ccc">
            <div style="width: 100%;">
                <div style="width: 33%; float: right; border: 1px solid #444; padding: 5px;">
                    <strong>IND-PERF-2310</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                        style="color: red; font-size: 15px">{{ $contrat->id }}</span></div>
            </div>
            <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
        </section>
        <section style="margin-top: 30px; margin-bottom: 7px; padding: 5px; font-family: Arial, sans-serif;">
            <div class="container-fluid">

                <!-- Contenu -->
                <div class="content1" style="margin-top: 0px; padding: 5px;">

                    <!-- Colonne gauche -->
                    <div style="width: 54%; float: left; padding: 7px 0;">
                        <div class="nom" style="margin-bottom: 10px;">
                            <label><strong>Conseiller : </strong><input type="text" class="input-border-bottom"
                                    style="width: 81%" value="{{ $contrat->nomagent ?? "" }}"> </label>
                        </div>

                        <div class="prenom" style="margin-bottom: 10px;">
                            <label><strong>Code Conseiller : </strong><input type="text" class="input-border-bottom"
                                    style="width: 72%" value="{{ $contrat->codeConseiller ?? "" }}"> </label>
                        </div>

                        <div class="birthday" style="margin-bottom: 10px;">
                            <label><strong>Unit Manager : </strong><input type="text" class="input-border-bottom"
                                    style="width: 76%" value="..."> </label>
                        </div>

                        <div class="domicile" style="margin-bottom: 10px;">
                            <label><strong>Manager : </strong><input type="text" class="input-border-bottom"
                                    style="width: 83%" value="..."> </label>
                        </div>

                        <div class="profession" style="margin-bottom: 10px;">
                            <label><strong>Réseau : </strong><input type="text" class="input-border-bottom"
                                    style="width: 85%" value="{{ $contrat->agenceData->libelle ?? "" }}"> </label>
                        </div>

                        <div class="civilite" style="width: 96%; border: 1px solid #444; padding: 5px;">
                            <strong>Police N° :</strong>
                        </div>
                    </div>

                    <!-- Colonne droite -->
                    <div style="width: 42%; float: right;">
                        <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/PERF_IND.png'))) }}"
                        alt="Logo" style="width: 100%">
                    </div>

                    <!-- Clear pour éviter les flottements -->
                    <div style="clear: both;"></div>

                </div>

            </div>
        </section>
        <section style="margin-top: 45px; margin-bottom: 25px; padding: 25px; margin: 0 auto">
            <div style="width: 100%; margin-top: 15px; text-align: center">
                <div style="width: 33%; float: left;">
                    <input type="radio" class="radio"> <strong style="font-size: 17px">Perfoma OBLIG </strong>
                </div>
                <div style="width: 33%; float: left;">
                    <input type="radio" class="radio"> <strong style="font-size: 17px">Perfoma EMERGENCE </strong>
                </div>
                <div style="width: 33%; float: left;">
                    <input type="radio" class="radio"> <strong style="font-size: 17px">Perfoma INVESTORS </strong>
                </div>
            </div>
            <div style="clear: both;"></div> <!-- Pour,eviter les problèmes d'affichage -->
        </section>
        <section style="margin-top: 10px; margin-bottom: 25px; padding: 80px 25px; borde: 1px solid #444;">
            <div
                style="width: 80%; margin: 0 auto; border: 1px solid #444; background-color: #dbdbdb; padding: 20px 50px; border-radius: 10px">
                <h1 style="text-align: center; font-size: 15px; margin-bottom: 15px">Nos Conseils pour souscrire à
                    PERFORMA</h1>
                <ol style="text-align: justify">
                    <li>Lisez attentivement les conditions de souscription à la dernière page du bulletin.</li><br>
                    <li>Discutez de toutes les questions d'assurances avec votre conseiller. Il aidera à mieux cerner
                        vos besoins et à mettre en place le plan d'assurance qui correspond le mieux à vos besoins.</li>
                    <br>
                    <li>N'hésitez pas à lui faire part des contrats d'assurances auxquels vous avez déjà souscrit.</li>
                    <br>
                    <li>Choisir le support d'investissement en cochant (mettant une croix dans la case ci-dessous)</li>
                    <br>
                    <li>Pour tout renseignement supplémentaire, appeler au 27 20 25 90 81 / 82 / 83</li>
                </ol>
            </div>
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
    <div class="a4-container">
        <section style="margin-bottom: 15px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
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
                <section style="width: 30%; margin: 5px 0; border: 1px solid #444; padding: 7px; border-radius: 7px">
                    <div style="width: 100%; text-align: center;">
                        <div style="width: 33%; float: left;">
                            <input type="radio" class="radio1" 
                                @if ($contrat->adherent->sexe == 'F') checked @endif><span>Mme</span>
                        </div>
                        <div style="width: 33%; float: left;">
                            <input type="radio" class="radio1" @if ($contrat->adherent->sexe == 'M') checked @endif><span>M</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Nom :
                        </strong><span>{{ $contrat->adherent->nom ?? ''}}</span></label>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <label><strong>Prénoms :
                        </strong><span>{{ $contrat->adherent->prenom ?? ''}}</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Né(e) le :
                        </strong><span>{{ $contrat->adherent->datenaissance ?? ''}}</span></label> &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <label><strong>à
                        </strong><span>{{ $contrat->adherent->lieunaissance ?? ''}}</span></label>
                </div>

                <section style="width: 80%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 45%; float: left;"><strong>Situation Matrimoniale :</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1" ><span>Célibataire</span></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><span>Marié(e)</span></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><span>Divorcé(e)</span></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><span>Veuf(ve)</span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>

                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Profession :
                        </strong><span>{{ $contrat->adherent->profession ?? ''}}</span></label> &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <label><strong>Employeur :
                        </strong><span>{{ $contrat->adherent->employeur ?? ''}}</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Adresse actuelle :
                        </strong><span>{{ $contrat->adherent->lieuresidence ?? ''}}</span></label> &nbsp;
                    &nbsp; &nbsp; &nbsp;
                    <label><strong>Adresse permanente :
                        </strong><span>{{ $contrat->adherent->lieuresidence ?? ''}}</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Téléphone courant :
                        </strong><span>{{ $contrat->adherent->mobile ?? ''}}</span></label> &nbsp; &nbsp;
                    &nbsp;
                    <label><strong>Téléphone permanente :
                        </strong><span>{{ $contrat->adherent->telephone ?? ''}}</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Cellulaire :
                        </strong><span>{{ $contrat->adherent->mobile1 ?? ''}}</span></label>
                    &nbsp; &nbsp; &nbsp;
                    <label><strong>E-mail :
                        </strong><span>{{ $contrat->adherent->email ?? ''}}</span></label>
                </div>
            </div>
        </section>
        <section style="margin-bottom: 15px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">II</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">ASSURE</h4>
            </div>
            <!-- Contenu -->
            <div class="content1" style="margin-top: 5px; padding: 10px;">

                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom complet</th>
                        <th>filliation</th>
                        <th>Né(e) le</th>
                        <th>Teléphone</th>
                        <th>Résidence</th>
                    </tr>
                    @foreach ($contrat->assures as $item)
                    <tr>
                        <td>{{ $item->nom ?? ''}} {{ $item->prenom ?? ''}}</td>
                        <td>{{ $item->filiation ?? ''}}</td>
                        <td>{{ $item->datenaissance ?? ''}}</td>
                        <td>{{ $item->telephone ?? ''}}</td>
                        <td>{{ $item->lieuresidence ?? ''}}</td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </section>
        <section style="margin-bottom: 15px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">III</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">BENEFICIAIRES</h4>
            </div>
            <!-- Contenu -->
            <div class="content1" style="margin-top: 5px; padding: 10px;">

                <div
                    style="width: 20%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                    <strong><i>1. Au terme du contrat</i></strong></div>
                <section style="width: 97%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1" 
                            @if ($contrat->beneficiaireauterme == 'adherent')
                            checked @endif><span>L'adherent</span>
                        </div>
                        <div style="width: 43%; float: left;"><input type="radio" class="radio1" @if ($contrat->beneficiaireauterme == 'Conjoint')
                            checked @endif><span>Le Conjoint
                                non séparé de corps, ni divorcé</span></div>
                        <div style="width: 33%; float: left;"><input type="radio" class="radio1" @if ($contrat->beneficiaireauterme == 'Enfants nés et à naitre')
                            checked @endif><span>Les enfants
                                nés et à naître</span></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"
                            @if ($contrat->beneficiaireauterme == 'autre')
                            checked @endif><span>Autres</span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <div class="content1" style="margin-top: 5px; padding: 10px;">

                    <div
                        style="width: 35%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                        <strong><i>2. En cas de décès avant terme du contrat</i></strong></div>
                    <section style="width: 97%; margin: 5px 0; padding: 7px; border-radius: 7px;">
    
                        <div style="width: 100%;">
                            <div style="width: 43%; float: left;"><input type="radio" class="radio1" @if ($contrat->beneficiaireaudeces == 'Conjoint')
                                checked @endif><span>Le Conjoint
                                    non séparé de corps, ni divorcé</span></div>
                            <div style="width: 33%; float: left;"><input type="radio" class="radio1" @if ($contrat->beneficiaireaudeces == 'Enfants nés et à naitre')
                                checked @endif><span>Les
                                    enfants nés et à naître</span></div>
                        </div>
                        <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                    </section>
    
                </div>
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom complet</th>
                        <th>filliation</th>
                        <th>Né(e) le</th>
                        <th>Teléphone</th>
                        <th>Résidence</th>
                    </tr>
                    @foreach ($contrat->beneficiaires as $item)
                    <tr>
                        <td>{{ $item->nom ?? ''}} {{ $item->prenom ?? ''}} </td>
                        <td>{{ $item->filiation ?? ''}}</td>
                        <td>{{ $item->datenaissance ?? ''}}</td>
                        <td>{{ $item->telephone ?? ''}}</td>
                        <td>{{ $item->lieuresidence ?? ''}}</td>
                    </tr>
                    @endforeach
                </table>

            </div>

            
        </section>
        <section style="margin-bottom: 15px; font-family: Arial, sans-serif;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">IV</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">PAYEUR DE PRIME</h4>
            </div>
            <!-- Contenu -->
            <div class="content1" style="margin-top: 5px; padding: 10px;">
                <section style="width: 97%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Le
                                Souscripteur</span></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"
                                checked><span>Autres</span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom complet</th>
                        <th>filliation</th>
                        <th>Date de naissance</th>
                        <th>Teléphone</th>
                        <th>Résidence</th>
                    </tr>
                    @foreach ($contrat->assures->where('filiation', 'souscripteur') as $item)
                    <tr>
                        <td>{{ $item->nom ?? ''}} {{ $item->prenom ?? ''}}</td>
                        <td>{{ $item->filiation ?? ''}}</td>
                        <td>{{ $item->datenaissance ?? ''}}</td>
                        <td>{{ $item->telephone ?? ''}}</td>
                        <td>{{ $item->lieuresidence ?? ''}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
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
    <div class="a4-container">
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">V</h4>
            </div>
            <div class=""
                style="width: 50%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">SOUSCRIPTION AU CONTRAT PERFORMA</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>Je souhaite souscrire au contrat "<strong> PERFORMA</strong>" pour une durée de <strong>{{ $contrat->duree ?? ''}}</strong> ANS en prenante éffet le <strong>{{ $contrat->dateeffet ?? ''}}</strong></label>
                </div>
                <div style="width: 100%; margin-top: 7px;">
                    <label>Le capital garanti au contrat doit être reservé au(x) bénéficiaire(s) sous la forme : </label><br><br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label> <input type="radio" class="radio1"> <span>d'un paiement unique à la date d'echéeance</span></label><br><br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label> <input type="radio" class="radio1" checked><span>d'une rente certaine payée</span></label><br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label><span>sur une duree de </span><b>{{ $contrat->duree ?? ''}}</b>ANS</label><br><br>
                
                </div>

                {{-- <section style="width: 80%; border-radius: 7px;"> --}}
                    <div style="width: 100%; margin-left: 100px; margin-top: -10px;">
                        <div style="width: 15%; float: left;"><span>par échéance</span></div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if ($contrat->periodicite == 'M')checked @endif>
                            <strong>Mensuelle</strong>
                        </div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if ($contrat->periodicite == 'T')checked @endif>
                            <strong>Trimestrielle</strong>
                        </div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if ($contrat->periodicite == 'S')checked @endif>
                            <strong>Semestrielle</strong>
                        </div>
                        <div style="width: 18%; float: left;">
                            <input type="radio" class="radio1" @if ($contrat->periodicite == 'A')checked @endif>
                            <strong>Annuelle</strong>
                        </div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                {{-- </section> --}}
            </div>
        </section>
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VI</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">COTISATION</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                
                <section style="width: 80%; border-radius: 7px; margin-bottom: 7px;">
                    <div style="width: 100%;">
                        <div style="width: 25%; float: left;"><span>Je souhaite payer par</span></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1" @if ($contrat->periodicite == 'M')checked @endif><strong>Mois</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1" @if ($contrat->periodicite == 'T')checked @endif><strong>Trimestre</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1" @if ($contrat->periodicite == 'S')checked @endif><strong>Semestre</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1" @if ($contrat->periodicite == 'A')checked @endif><strong>Année</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1" @if ($contrat->periodicite == 'U')checked @endif><strong>Unique</strong></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <label><span>sur une duree de </span><b>{{ $contrat->duree ?? ''}}</b>ANS,</label>
                <label><span>une cotisation de </span><b>{{ $contrat->primepricipale ?? ''}}</b>FCFA + <b>{{ $contrat->surprime ?? 0}}  <i>(Frais accessoire)</i></b>FCFA = <b>{{ number_format($contrat->prime) ?? 0}}</b>FCFA</label>
            </div>
        </section>

        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VII</h4>
            </div>
            <div class=""
                style="width: 40%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">CHOIX D'INVESTISSEMENT</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px; text-align: center;">
                <!-- Colonne gauche -->
                    <h1 style="text-align: center; font-size: 14px; margin-bottom: 12px">Répartition pour mes versements</h1>
                <label><strong>FONDS GARANTI &nbsp;&nbsp;</strong><u><b>60%</b></u></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label><strong>UNITES DE COMPTE &nbsp;&nbsp;</strong><u><b>40%</b></u> (investi dans les OPCVM)</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label><strong>TOTAL &nbsp;&nbsp;</strong><u><b>100%</b></u></label>
            </div>
        </section>

        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VIII</h4>
            </div>
            <div class=""
                style="width: 50%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">SOUSCRIPTION AU CAPITAL SURETE</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>La prime en couverture de CAPITAL SURETE est payée en sus de la COTISATION D'ASSURANCE et en même temps qu'elle</label>
                </div>
                <div style="width: 100%; margin-top: 7px;">
                    <label style="margin-top: 0px; margin-left:20px; display:block"> <input type="radio" class="radio1"> Je souhaite souscrit au CAPITAL SURETE de <span><b>..................</b> FCFA</span></label>
                    <label style="margin-top: 5px; margin-left:60px; display:block"><span>Pour une prime additionnelle de </span><b>..................</b> FCFA</label>
                                    
                </div>
            </div>
        </section>

        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">IX</h4>
            </div>
            <div class=""
                style="width: 60%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">PAIEMENT DE LA COTISATION ET DES PRIMES</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>La prime d'Assurance d'un montant total de <span><b>..................</b> FCFA</span> sera payée par :</label>
                </div>
                <div style="width: 100%; margin-top: 10px;">
                    <label style="margin-top: 0px; margin-left:20px; display:block"> <input type="radio" class="radio1"checked>Prélèvement bancaire sur mon compte (<small><i>Joindre l'attestation de prélèvement et un relevé d'identité bancaire</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Retenue sur salaire auprès de mon employeur (<small><i>Joindre l'autorrisation de retenue à la source</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Chèque (<small><i>à l'ordre exclusif de <strong>YAKO AFRICA Assurances Vie</strong></i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Espèces (<small><i>exclusivement aux guides de <strong>YAKO AFRICA Assurances Vie</strong> ou auprès des mandataires autorisés</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Autres, préciser : &nbsp; <b>...............................................................................................................................................</b></label>              
                </div>
                <div style="width: 100%; margin-top: 7px;">

                    <label>La première échéance de la prime sera payée par :</label>
                </div>
                <div style="width: 100%; margin-top: 10px;">
                    <label style="margin-top: 0px; margin-left:20px; display:block"> <input type="radio" class="radio1"checked>Prélèvement bancaire sur mon compte (<small><i>Joindre l'attestation de prélèvement et un relevé d'identité bancaire</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Retenue sur salaire auprès de mon employeur (<small><i>Joindre l'autorrisation de retenue à la source</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Chèque (<small><i>à l'ordre exclusif de <strong>YAKO AFRICA Assurances Vie</strong></i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Espèces (<small><i>exclusivement aux guides de <strong>YAKO AFRICA Assurances Vie</strong> ou auprès des mandataires autorisés</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Autres, préciser : &nbsp; <b>...............................................................................................................................................</b></label>              
                </div>
            </div>
        </section>

        <section style="margin-bottom: 7px; font-family: Arial, sans-serif;">
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 0px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label style="text-align: justify"><strong>Je reconnais avoir reçu et pris connaissaice des Conditions Générales valant Notice d'Information du contrat PERFORMA et notamment de mon droit à la renonciation.</strong></label>
                </div>
                <div style="width: 100%; margin-top: 5px;">

                    <label style="text-align: justify"><strong>Je reconnais être parfaitement informé du fait que la fiscalité applicable au contrat d'assurance PERFORMA, ainsi que les avantages qui en résultent, son susceptibles de varier dans le temps.</strong></label>
                </div>
                <div style="width: 100%; margin-top: 5px;">

                    <label style="text-align: justify"><strong>Je reconnais également avoir pris connaissance des caractéristiques des OPCVM, de la Note d'Information et du Règlement susceptibles de varier dans le temps.</strong></label>
                </div>
                <div style="width: 100%; margin-top: 5px;">

                    <label style="text-align: justify"><strong>Les titulaires du contrat PERFORMA ne sont pas adhérents du fonds. Dès lors, ils n'ont pas un droit de propriété sur l'actif du fonds dans lequel une partie de leur cotisation à été investie. Leurs droits sont uniquement attachés au contrat d'assurance PERFORMA.</strong></label>
                </div>

                <div style="width: 100%; margin-top: 10px;">

                    <label>Fait à : <strong> {{ $contrat->user->membre->zone->libellezone ?? '' }}  </strong> le <strong> {{ \Carbon\Carbon::parse($contrat->saisiele)->format('d/m/Y à H:i:s') ?? '' }} </strong></label>
                </div>
            </div>
        </section>
        <section style="width: 100%; margin-top: 7px;">
            <div style="width: 100%; text-align: center;">
                <div style="width: 49%; float: left">
                    <strong>Signature du souscripteur</strong>
                    {{-- <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p> --}}
                    <div style="width: 100%;">
                        <div style="text-align: center; width: 45%; float: left">
                            <img src="{{ $qrCodeBase64 }}" alt="QR Code de vérification" style="width: 60px; height: 60px;">
                        </div>
                        <div style="text-align: center; width: 45%; float: right">
                            @if ($imageSrc != null)
                                <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 55px; height: 55px;">
                            @endif
                        </div>
                    </div>
                </div>
                {{-- <div style="width: 33%; float: left;">
                    <strong>Signature de l'Assuré</strong>
                    <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p>
                </div> --}}
                <div style="width: 49%; float: right;">
                    <strong>Signature du Conseiller</strong> 
                    <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p>
                </div>
            </div>
            <div style="clear: both;"></div>
        </section>
    </div>
</body>

</html>

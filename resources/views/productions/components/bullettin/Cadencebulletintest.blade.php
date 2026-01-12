<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription CADENCE</title>
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
                        </h2>
                </div>

            </div>
        </section>
        <section style="margin-top: 10px">
            <div>
                <CENTER>
                    <h1><i style="font-size: 25px">Proposition d'Assurance</i></h1>
                </CENTER>
            </div>
        </section>
        <section style="height: 40px; margin-top: 15px;">
            <div style="width: 100%;">
                <div style="width: 55%; margin: auto; border: 1px solid #444; padding: 7px; border-radius: 7px;">
                    <strong style="font-size: 15px">IND-CAD-2410</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                        style="color: red; font-size: 20px">000000</span></div>
            </div>
            <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
        </section>
        <section style="margin-top: 20px; margin-bottom: 0px; padding: 5px; font-family: Arial, sans-serif;">
            <div class="container-fluid">

                <!-- Contenu -->
                <div class="content1" style="margin-top: 0px; padding: 5px;">
                    <h1 style="text-align: center; font-size: 100px; color: #368257">Cadence</h1>
                </div>

            </div>
        </section>
        <section style="margin-top: 20px; margin-bottom: 25px; padding: 15px; margin: 0 auto">
            <div style="margin-top: 15px; text-align: justify; background-color: #444444b3; padding: 10px; border-radius: 5px">
                <p style="color: #fff">Cet encadré a pour objectif d'attirer l'attention du souscripteur sur certaines dispositions éssentielles de la proposition d'assurance. Il est important que le souscripteur lise intégralement la proposition d'assurance, et pose les questions qu'il estime nécessaires avant de signer la contrat.</p>
            </div>
            <div style="width: 100%; margin-top: 25px; text-align: center">
                <div style="width: 33%; float: left;">
                    <input type="radio" class="radio"> <strong style="font-size: 17px">Retraite Pension </strong>
                </div>
                <div style="width: 33%; float: left;">
                    {{-- <input type="radio" class="radio"> <strong style="font-size: 17px"></strong> --}}
                </div>
                <div style="width: 33%; float: left;">
                    <input type="radio" class="radio"> <strong style="font-size: 17px">Investissement </strong>
                </div>
            </div>
            <div style="clear: both;"></div> <!-- Pour,eviter les problèmes d'affichage -->
        </section>
        <section style="margin-top: 0px; margin-bottom: 25px; padding: 5px; borde: 1px solid #444;">
            <div style="padding: 4px; border: 1px solid #444; border-radius: 10px">
                <div style="margin: 0 auto; border: 1px solid #444; background-color: #dbdbdb22; padding: 20px 50px; border-radius: 10px">
                    <h1 style="text-align: center; font-size: 15px; margin-bottom: 15px">Nos Conseils pour souscrire à
                        Cadence</h1>
                    <ol style="text-align: justify">
                        <li>Lisez attentivement la notice d'information à la dernière page de la proposition d'assurance.</li><br>
                        <li>Discutez de toutes les questions d'assurances avec votre conseiller. Il aidera à mieux cerner
                            vos besoins et à mettre en place un contrat d'assurance personnalisé.</li>
                        <br>
                        <li>N'hésitez pas à lui faire part des contrats d'assurances auxquels vous avez déjà souscrit.</li>
                        <br>
                        <li>Pour tout renseignement supplémentaire, appeler au 27 20 22 94 64 / 27 20 33 15 00</li>
                    </ol>
                </div>
            </div>
        </section>
        <section style="margin-top: 30px; margin-bottom: 7px; padding: 5px; font-family: Arial, sans-serif;">
            <div class="container-fluid">

                <!-- Contenu -->
                <div class="content1" style="margin-top: 0px; padding: 5px; border: 1px solid #444; border-radius: 7px; background-color: #dbdbdb22">

                    <!-- Colonne gauche -->
                    <div style="width: 54%; float: left; padding: 7px 5px;">
                        <div class="nom" style="margin-bottom: 10px;">
                            <label><strong>Conseiller : </strong><input type="text" class="input-border-bottom"
                                    style="width: 81%" value="Nom Prenoms"> </label>
                        </div>

                        <div class="birthday" style="margin-bottom: 10px;">
                            <label><strong>Unit Manager : </strong><input type="text" class="input-border-bottom"
                                    style="width: 76%" value="Unit Manager"> </label>
                        </div>

                        <div class="prenom" style="margin-bottom: 10px;">
                            <label><strong>Assistant Manager : </strong><input type="text" class="input-border-bottom"
                                    style="width: 67%" value="Assistant Manager"> </label>
                        </div>

                        <div class="domicile" style="margin-bottom: 10px;">
                            <label><strong>Manager : </strong><input type="text" class="input-border-bottom"
                                    style="width: 83%" value="Manager"> </label>
                        </div>

                        <div class="profession" style="margin-bottom: 10px;">
                            <label><strong>Réseau : </strong><input type="text" class="input-border-bottom"
                                    style="width: 85%" value="Réseau"> </label>
                        </div>
                    </div>

                    <!-- Colonne droite -->
                    <div style="width: 42%; float: right; padding: 7px 0px;">
                        <div class="nom" style="margin-bottom: 10px;">
                            <label><strong>Code : </strong><input type="text" class="input-border-bottom"
                                    style="width: 81%" value="Code conseiller"> </label>
                        </div>

                        <div class="prenom" style="margin-bottom: 10px;">
                            <label><strong>Code : </strong><input type="text" class="input-border-bottom"
                                    style="width: 81%" value="Code Unit Manager"> </label>
                        </div>

                        <div class="birthday" style="margin-bottom: 10px;">
                            <label><strong>Code : </strong><input type="text" class="input-border-bottom"
                                    style="width: 81%" value="Code assistant Manager"> </label>
                        </div>

                        <div class="domicile" style="margin-bottom: 10px;">
                            <label><strong>code : </strong><input type="text" class="input-border-bottom"
                                    style="width: 81%" value="Code Manager"> </label>
                        </div>
                    </div>

                    <!-- Clear pour éviter les flottements -->
                    <div style="clear: both;"></div>

                </div>

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
        <section style="margin-bottom: 25px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
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
                        <div style="width: 33%; float: left;"><input type="radio" class="radio1"><span>Mme</span>
                        </div>
                        <div style="width: 33%; float: left;"><input type="radio" class="radio1"><span>Mlle</span>
                        </div>
                        <div style="width: 33%; float: left;"><input type="radio" class="radio1"><span>M</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Nom :
                        </strong><span>.............................................................</span></label>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <label><strong>Prénoms :
                        </strong><span>.............................................................................................</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Né(e) le :
                        </strong><span>.......................................................</span></label> &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <label><strong>à
                        </strong><span>..............................................................................................................</span></label>
                </div>

                <section style="width: 80%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 45%; float: left;"><strong>Situation Matrimoniale :</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><span>Célibataire</span></div>
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
                        </strong><span>.......................................................</span></label> &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <label><strong>Employeur :
                        </strong><span>..........................................................................................</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Adresse actuelle :
                        </strong><span>.......................................................</span></label> &nbsp;
                    &nbsp; &nbsp; &nbsp;
                    <label><strong>Adresse permanente :
                        </strong><span>..........................................................................</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Téléphone courant :
                        </strong><span>....................................................</span></label> &nbsp; &nbsp;
                    &nbsp;
                    <label><strong>Téléphone permanente :
                        </strong><span>.......................................................................</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>CNI :
                        </strong><span>.............................................................................</span></label>
                    &nbsp; &nbsp; &nbsp;
                    <label><strong>E-mail :
                        </strong><span>...................................................................................................</span></label>
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
                    <tr>
                        <td>Dupont</td>
                        <td>Fils de Jean Dupont</td>
                        <td>01/01/1990</td>
                        <td>Paris</td>
                        <td>Lyon</td>
                    </tr>
                    <tr>
                        <td>Durand</td>
                        <td>Fils de Marie Durand</td>
                        <td>12/05/1985</td>
                        <td>Marseille</td>
                        <td>Bordeaux</td>
                    </tr>
                </table>
                
            </div>
            <div style="width: 33%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                <strong><i>personne à contacter en cas d'urgence</i></strong>
            </div>
            <div style="width: 100%; margin: 15px 0; ">
                <label><strong>Nom et prénoms :
                    </strong><span>.................................................................................................</span></label>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                <label><strong>Contact :
                    </strong><span>.........................................................</span></label>
            </div>
            <div style="width: 100%; margin: 15px 0; ">
                <label><strong>Nom et prénoms :
                    </strong><span>.................................................................................................</span></label>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                <label><strong>Contact :
                    </strong><span>.........................................................</span></label>
            </div>
        </section>
        <section style="margin-bottom: 25px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
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

                <div style="width: 20%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                    <strong><i>1. Au terme du contrat</i></strong></div>
                <section style="width: 97%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"
                                checked><span>L'assué</span></div>
                        <div style="width: 43%; float: left;"><input type="radio" class="radio1"><span>Le Conjoint
                                non séparé de corps, ni divorcé</span></div>
                        <div style="width: 33%; float: left;"><input type="radio" class="radio1"><span>Les enfants
                                nés et à naître</span></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"
                                checked><span>Autres</span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom complet</th>
                        <th>filliation</th>
                        <th>Né(e) le</th>
                        <th>Teléphone</th>
                        <th>Résidence</th>
                    </tr>
                    <tr>
                        <td>Dupont</td>
                        <td>Fils de Jean Dupont</td>
                        <td>01/01/1990</td>
                        <td>Paris</td>
                        <td>Lyon</td>
                    </tr>
                    <tr>
                        <td>Durand</td>
                        <td>Fils de Marie Durand</td>
                        <td>12/05/1985</td>
                        <td>Marseille</td>
                        <td>Bordeaux</td>
                    </tr>
                </table>

            </div>

            <div class="content1" style="margin-top: 5px; padding: 10px;">

                <div
                    style="width: 35%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                    <strong><i>2. En cas de décès avant terme du contrat</i></strong></div>
                <section style="width: 97%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        {{-- <div style="width: 18%; float: left;"><input type="radio" class="radio1" checked><span>L'assué</span></div> --}}
                        <div style="width: 43%; float: left;"><input type="radio" class="radio1"><span>Le Conjoint
                                non séparé de corps, ni divorcé</span></div>
                        <div style="width: 33%; float: left;"><input type="radio" class="radio1" checked><span>Les
                                enfants nés et à naître</span></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"
                                checked><span>Autres</span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom complet</th>
                        <th>filliation</th>
                        <th>Né(e) le</th>
                        <th>Teléphone</th>
                        <th>Résidence</th>
                    </tr>
                    <tr>
                        <td>Dupont</td>
                        <td>Fils de Jean Dupont</td>
                        <td>01/01/1990</td>
                        <td>Paris</td>
                        <td>Lyon</td>
                    </tr>
                    <tr>
                        <td>Durand</td>
                        <td>Fils de Marie Durand</td>
                        <td>12/05/1985</td>
                        <td>Marseille</td>
                        <td>Bordeaux</td>
                    </tr>
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
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">IV</h4>
            </div>
            <div class=""
                style="width: 50%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">SOUSCRIPTION AU CONTRAT CADENCE</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>Je souhaite souscrire au contrat "<strong> CADENCE</strong>" pour une durée de <strong>.......</strong> ANS en prenante éffet le <strong>........................</strong></label>
                </div>
                <div style="width: 100%; margin-top: 7px;">
                    <label>Le capital garanti au contrat doit être reservé au(x) bénéficiaire(s) sous la forme : </label><br><br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label> <input type="radio" class="radio1"> <span>d'un paiement unique à la date d'echéeance</span></label><br><br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label> <input type="radio" class="radio1"><span>d'une rente certaine payée</span></label><br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label><span>sur une duree de </span><b>..........</b>ANS</label><br><br>
                
                </div>

                {{-- <section style="width: 80%; border-radius: 7px;"> --}}
                    <div style="width: 100%; margin-left: 100px; margin-top: -10px;">
                        <div style="width: 15%; float: left;"><span>par échéance</span></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Mensuelle</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Trimestrielle</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Semestrielle</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Annuelle</strong></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                {{-- </section> --}}
            </div>
        </section>
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">V</h4>
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
                                class="radio1"><strong>Mois</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Trimestre</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Semestre</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Année</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><strong>Unique</strong></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <label><span>sur une duree de </span><b>..........</b>ANS,</label>
                <label><span>une cotisation de </span><b>..................</b>FCFA + <b>.................. <i>(Frais accessoire)</i></b>FCFA = <b>......................</b>FCFA</label><br><br>
                <label><span>Frais unique d'Adhésion : </span><b>7 500 FCFA </b></label> <br><br>
                <section style="width: 90%; border-radius: 7px; margin-bottom: 7px;">
                    <div style="width: 100%;">
                        <div style="width: 38%; float: left;"><span>Adhésion aux services en ligne e-Nov : </span></div>
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
            <div class="" style="width: 2%; background-color: #747171; padding: 14px 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VI</h4>
            </div>
            <div class=""
                style="width: 95%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">SOUSCRIPTION AU CAPITAL SURETE ET À LA GARANTIE COMPLEMENTAIRE DECÈS ACCIDENTEL</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>Les primes en couverture de <strong>CAPITAL SURETE</strong> et de <strong>garantie complementaire DECÈS ACCIDENTEL</strong>sont payées en sus de la COTISATION D'ASSURANCE et en même temps qu'elle</label>
                </div>
                <div style="width: 100%; margin-top: 7px;">
                    <label style="margin-top: 0px; margin-left:20px; display:block"> <input type="radio" class="radio1"> Je souhaite souscrit au CAPITAL SURETE de <span><b>..................</b> FCFA</span> <span> pour une prime de </span><b>..................</b> FCFA</label>
                    <label style="margin-top: 7px; margin-left:20px; display:block"> <input type="radio" class="radio1"> Je souhaite souscrit au CAPITAL ACCIDENT de <span><b>..................</b> FCFA</span> <span> pour une prime de </span><b>..................</b> FCFA</label>
                                    
                </div>
            </div>
        </section>

        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VII</h4>
            </div>
            <div class=""
                style="width: 60%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">PAIEMENT DE LA COTISATION ET DES PRIMES</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>La cotisation et les primes d'Assurance d'un montant total de <span><b>..................</b> FCFA</span> seront payée par :</label>
                </div>
                <div style="width: 100%; margin-top: 10px;">
                    <label style="margin-top: 0px; margin-left:20px; display:block"> <input type="radio" class="radio1"checked>Prélèvement bancaire sur mon compte (<small><i>Joindre l'attestation de prélèvement et un relevé d'identité bancaire</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Retenue sur salaire auprès de mon employeur (<small><i>Joindre l'autorrisation de retenue à la source</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Chèque (<small><i>à l'ordre exclusif de <strong>YAKO AFRICA Assurances Vie</strong></i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Espèces (<small><i>exclusivement aux guides de <strong>YAKO AFRICA Assurances Vie</strong> ou auprès des mandataires autorisés</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Moble money ou Internet</label>
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
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Moble money ou Internet</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio" class="radio1">Autres, préciser : &nbsp; <b>...............................................................................................................................................</b></label>              
                </div>
            </div>
        </section>

        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px 7px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VIII</h4>
            </div>
            <div class=""
                style="width: 55%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 33px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">CONSTITUTION DU FONDS D'OPERATION</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px; text-align: center;">
                <!-- Colonne gauche -->
                    <label style="">Le fonds d'operation est constitué sur la base de ............................. <i style="font-size: 10px !important">(Maximum -50% de la cotisation annuelle)</i> par année</label>
                
            </div>
        </section>
        <section style="width: 100%; margin-top: 7px;">
            <div style="width: 100%; margin-top: 10px; margin-bottom: 7px;">

                <label>Fait à <strong>................................................ </strong> le <strong> ................................................</strong></label>
            </div>
            <div style="width: 100%; text-align: center;">
                <div style="width: 33%; float: left;">
                    <strong>Signature du souscripteur</strong>
                    <div>
                        {{-- @if ($imageSrc != null)
                            <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 55px; height: 55px;">
                        @endif --}}
                    </div>
                    {{-- <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p> --}}
                </div>
                <div style="width: 33%; float: left;">
                    <strong>Signature de l'Assuré</strong>
                    <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p>
                </div>
                <div style="width: 33%; float: left;">
                    <strong>Signature du Conseiller</strong> 
                    <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p>
                </div>
            </div>
            <div style="clear: both;"></div>
        </section>
    </div>
</body>

</html>

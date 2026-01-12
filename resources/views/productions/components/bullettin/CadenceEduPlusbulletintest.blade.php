<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription Cadence Education Plus</title>
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

        .footer-fixed {

            position: fixed;
            height: 140px;
            bottom: 0;
        }

        @media print {
            .footer-fixed {
                position: fixed;
                bottom: 0;
            }
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

        .padding {
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
        <section style="height: 40px; margin-top: 15px;">
            <div style="width: 95%; margin: auto">
                <div
                    style="width: 46%; margin: auto; border: 1px solid #444; padding: 5px; border-radius: 7px; float:left">
                    <strong style="font-size: 15px">Police N° </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="color: red; font-size: 20px">000000</span>
                </div>

                <div
                    style="width: 46%; margin: auto; border: 1px solid #444; padding: 5px; border-radius: 7px; float:right">
                    <strong style="font-size: 15px">IND-CEP-2304-</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                        style="color: red; font-size: 20px">000000</span>
                </div>
            </div>
            <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
        </section><br>
        <section style="margin-top: 20px; margin-bottom: 0px; padding: 5px; font-family: Arial, sans-serif;">
            <div class="container-fluid">

                <!-- Contenu -->
                <div class="content1" style="margin-top: 0px; padding: 5px;">
                    <h1 style="text-align: center; font-size: 85px; color: #368257; line-height: 0.8">Cadence<span
                            style="background-color:#F8B133; color: #FFF; font-size: 70px; font-style:italic; padding:15px; width:45% height:50%; border-radius:100% 65% 100% 65%">Plus</span>
                    </h1>
                    <p style="text-align: center; font-size: 38px; color: #368257; line-height: 0.8">
                        &nbsp;&nbsp;Education</p>
                </div>

            </div>
        </section>
        <section style="margin-top: 20px; margin-bottom: 25px; padding: 15px; margin: 0 auto">
            <div
                style="margin-top: 15px; text-align: justify; background-color: #444444b3; padding: 10px; border-radius: 5px">
                <p style="color: #fff">Cet encadré a pour objectif d'attirer l'attention du souscripteur sur certaines
                    dispositions éssentielles de la proposition d'assurance. Il est important que le souscripteur lise
                    intégralement la proposition d'assurance, et pose les questions qu'il estime nécessaires avant de
                    signer la contrat.</p>
            </div>
            <div style="clear: both;"></div> <!-- Pour,eviter les problèmes d'affichage -->
        </section>
        <section style="margin-top: 0px; margin-bottom: 15px; padding: 5px;">
            <div style="padding: 4px; border: 1px solid #444; border-radius: 10px">
                <div
                    style="margin: 0 auto; border: 1px solid #444; background-color: #dbdbdb22; padding: 7px 50px; border-radius: 10px">
                    <ol style="text-align: justify">
                        <li style="margin-bottom: 8px">Le contrat <strong style="text-transform: uppercase">Cadence Education Plus</strong> est un
                            contrat d'assurance vie individuel.</li>
                        <li style="margin-bottom: 8px">Le contrat <strong style="text-transform: uppercase">Cadence Education Plus</strong> offre
                            deux(3) garanties de base "<strong>ETUDE</strong>", "<strong>SÛRETE</strong>" et
                            "<strong>RENTE</strong>" et une garantie optionnelle "<strong>OBSÈQUES</strong>" :
                            <ol type="a" style="text-align: justify; margin-left: 20px">
                                <li>La Garantie <strong>ETUDE</strong> donne droit à une prestation égale à l'épargne
                                    constituée (Provision Mathématique).</li>
                                <li>La Garantie <strong>SÛRETE</strong> donne droit au paiement à terme d'une prestation égale au capital souscrit en cas de décès de la personne assurée.</li>
                                <li>La Garantie <strong>RENTE</strong> donne droit au versement de rente en cas de décès de la personne assurée pour assurer la scolarité l'enfant.</li>
                                <li>La Garantie <strong>OBSÈQUES</strong> donne droit au paiement immédiat d'un capital en cas de décès de la personne assurée pour l'organisation des obsèques.</li>
                            </ol>
                        </li>
                        <li style="margin-bottom: 8px">Au terme du contrat, le capital est payé dans les <strong>QUINZE (15) JOURS</strong> suivant
                            la remise de toutes les pièces prévues au contrat.</li>
                        <p style="margin-bottom: 8px">En cas de décès de l'assuré avant terme du contrat, dans le cadre de la garantie <strong>OBSÈQUES</strong>, le capital est payé au(x) bénéficiaire(s) désigné(s), à défaut, aux ayants droit de l'assuré, dans le délai de <strong>TRENTE (30) JOURS</strong> suivant la remise de toutes les pièces justificatives.</p>
                        <p style="margin-bottom: 8px">En cas de décès de l'assuré avant terme du contrat, dans le cadre de la garantie <strong>RENTE</strong>, les rentes sont remise au(x) bénéficiaire(s) désigné(s), à défaut, aux ayants droit de l'assuré le 1er JANVIER de chaque année jusqu'au terme du contrat.</p>
                        
                        <li style="margin-bottom: 8px">Chaque année, la participation aux bénéfices est déterminée à partir de moins de 90% des
                            resultats techniques et 85% des resultats financiers, conformement aux dispositions des
                            articles 82, 83 et 84 du code CIMA et virée au compte "Provision pour la participation aux
                            bénéfices". Les provisions constituées sont repartis aux assurés, après approbation du
                            Conseil d'Administration de <strong>YAKO AFRICA</strong>.</li>
                        <li style="margin-bottom: 8px">
                            Le contrat <strong style="text-transform: uppercase">Cadence Education Plus</strong> prévoit une faculté de rachat lorsque deux (2) primes
                            annuelles au moins ou 15% de l'ensemble des primes prévues au contrat ont été payées.
                            Les sommes demendées dans le cas des rachats sont versées par <strong>YAKO AFRICA</strong>
                            dans un délai de <strong>SOIXANTE (60) JOURS</strong> suivant la date réception de la
                            demande de rachat.
                            Les valeurs de rachat au terme de chacune des huit (8) premières années au moins ainsi que
                            la somme des primes versées au terme de chacune des même années sont indiquées sur les
                            conditions particulières du contrat. Le <strong style="text-transform: uppercase">Cadence Education Plus</strong> prévoit également des
                            avances le montant ne saurait dépasser 75% de la provision constituée.<br>
                        </li>
                        <li style="margin-bottom: 8px">
                            Les Chargements prélevés au contrat sont :
                            <ul style="text-align: justify; margin-left: 20px">
                                <li>Chargement d'acquisition : 35% de la première prime annuelle en couverture de la
                                    garantie <strong>ETUDE</strong>.</li>
                                <li>Chargement d'administration et de gestion sur la garantie <strong>ETUDE</strong> :
                                    7% de chaque prime.</li>
                                <li>Chargement d'administration et de gestion sur la garantie <strong>SÛRETE</strong>, <strong>RENTE</strong> et <strong>OBSÈQUES</strong> :
                                    15% de chaque prime.</li>
                                <li>Frais unique de souscription : 7 500 FCFA.</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
    </div>
    <div class="a4-container">
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
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
                <section style="width: 100%; margin: 5px 0; padding: 7px; border-radius: 7px;">
                    <div style="width: 100%;">
                        <div style="width: 18%; float: left;"><input type="radio"
                                class="radio1"><span>Passeport</span>
                        </div>
                        <div style="width: 12%; float: left;"><input type="radio" class="radio1"><span>CNI</span>
                        </div>
                        <div style="width: 10%; float: left;"><input type="radio" class="radio1"><span>PC</span>
                        </div>
                        <div style="width: 10%; float: left;"><input type="radio" class="radio1"><span>CC</span>
                        </div>
                        <div style="width: 50%; float: left;"><span>N°</span> <input type="text"
                                style="width: 90%; padding: 2px" value="CI0039ZYT">
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
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Marié(e)</span>
                        </div>
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
                    <label><strong>Lieu de residence :
                        </strong><span>..............................................................................................................................................................................</span></label>
                    &nbsp;

                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Téléphone courant :
                        </strong><span>....................................................</span></label> &nbsp; &nbsp;
                    &nbsp;
                    <label><strong>N° Whatsapp :
                        </strong><span>.......................................................................</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>Adresse :
                        </strong><span>.......................................................................</span></label>
                    &nbsp; &nbsp;
                    <label><strong>E-mail :
                        </strong><span>...................................................................................................</span></label>
                </div>
            </div>
        </section>
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
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
            <div
                style="width: 33%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                <strong><i>personne à contacter en cas d'urgence</i></strong>
            </div>
            <div style="width: 100%; margin: 15px 0; ">
                <label><strong>Nom et prénoms :
                    </strong><span>.................................................................................................</span></label>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <label><strong>Contact :
                    </strong><span>.........................................................</span></label>
            </div>

        </section>


        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">III</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">BENEFICIAIRES</h4>
            </div>
            <!-- Contenu -->
            <!-- Contenu -->
            <div class="content1" style="margin-top: 5px; padding: 10px;">

                <div
                    style="width: 20%; background-color: #7471718b; padding: 5px; border-radius: 15px; text-align: center">
                    <strong><i>1. Au terme du contrat</i></strong>
                </div>
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
                    <strong><i>2. En cas de décès avant terme du contrat</i></strong>
                </div>
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
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">IV</h4>
            </div>
            <div class=""
                style="width: 40%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">SOUSCRIPTION AU CONTRAT</h4>
            </div>
            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>Je souhaite souscrire au contrat "<strong style="text-transform: uppercase">Cadence
                            Education Plus</strong>" pour une durée de <strong>.......</strong> ANS en prenante éffet le
                        <strong>........................</strong></label>
                </div><br>
                {{-- <section style="width: 80%; border-radius: 7px;"> --}}
                <div style="width: 100%; margin-left: 70px; margin-top: -10px;">
                    <div style="width: 15%; float: left;"><span>Périodicité :</span></div>
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
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->

                <label><span>CAPITAL ETUDE </span><b>..................</b>FCFA
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MONTANT
                    PRIME <b>......................</b>FCFA</label><br><br>
                <label><span>Frais unique d'Adhésion : </span><b>7 500 FCFA </b></label> <br><br>
                <section style="width: 90%; border-radius: 7px; margin-bottom: 7px;">
                    <div style="width: 100%;">
                        <div style="width: 38%; float: left;"><span>Adhésion aux services en ligne e-Nov : </span>
                        </div>
                        <div style="width: 35%; float: left;"><input type="radio" class="radio1"><strong>Abonnement
                                mensuel: 500 FCFA</strong></div>
                        <div style="width: 35%; float: left;"><input type="radio" class="radio1"><strong>Abonnement
                                annuelle: 6000 FCFA</strong></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
            </div>
        </section>

        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">V</h4>
            </div>
            <div class=""
                style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">PAIEMENT DES PRIMES</h4>
            </div>

            <!-- Contenu -->
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%; margin-top: 0px;">

                    <label>La cotisation et les primes d'Assurance d'un montant total de <span><b>..................</b>
                            FCFA</span> seront payée par :</label>
                </div>

                <div style="width: 100%; margin-top: 10px;">
                    <label style="margin-top: 0px; margin-left:20px; display:block"> <input type="radio"
                            class="radio1"checked>Prélèvement bancaire sur mon compte (<small><i>Joindre l'attestation
                                de prélèvement et un relevé d'identité bancaire</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio"
                            class="radio1">Retenue sur salaire auprès de mon employeur (<small><i>Joindre
                                l'autorrisation de retenue à la source</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio"
                            class="radio1">Chèque (<small><i>à l'ordre exclusif de <strong>YAKO AFRICA Assurances
                                    Vie</strong></i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio"
                            class="radio1">Espèces (<small><i>exclusivement aux guides de <strong>YAKO AFRICA
                                    Assurances Vie</strong> ou auprès des mandataires autorisés</i></small>)</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio"
                            class="radio1">Moble money ou Internet</label>
                    <label style="margin-top: 5px; margin-left:20px; display:block"> <input type="radio"
                            class="radio1">Autres, préciser : &nbsp;
                        <b>...............................................................................................................................................</b></label>
                </div>

            </div>
        </section>
        <section style="margin-bottom: 7px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
            <!-- Titre -->
            <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VI</h4>
            </div>
            <div class=""
                style="width: 65%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                <h4 style="color: #fff; font-size: 15px; margin: 0;">DECLARATION SUR l'ETAT DE SANTE (À remplir par
                    l'assuré) </h4>
            </div>
            <section style="margin-top: 10px; margin-bottom: 0px; padding: 5px; borde: 1px solid #444;">
                <div style="padding: 4px; border: 1px solid #444;  background-color: #dbdbdb22; border-radius: 10px">
                    <div style="margin: 0 auto; padding: 10px 50px; border-radius: 10px">

                        <ul style="text-align: justify">
                            <li>Les déclarations de l'adhérent consistent la base du contrat d'assurance.</li><br>
                            <li>Nous vous invitons par conséquent à repondre au questionnaire ci-déssous avec sincérité
                                et exactitude.</li>
                            <br>
                            <li>Notez que vos déclarations sont strictement confidentielle et permettent uniquement à
                                l'assureur de faire un contrat qui correspond à vos besoins spécifiques.</li>
                            <br>
                            <li>À toutes fins utiles, nous vous rappelons que l'assureur, en application de l'artucle 18
                                du code CIMA, se réserve le droit de vérifier l'exactitude des déclarationset pourrait
                                refuser de payer le capital décès en cas de fausses déclarations intentionnelles.</li>
                        </ul>
                    </div>
                </div>
            </section>
            <div class="content" style="margin-top: 0px; padding: 10px;">
                <!-- Colonne gauche -->
                <div style="width: 100%;">
                    <label><strong>Nom :
                        </strong><span>...........................</span></label>
                    &nbsp; &nbsp;
                    <label><strong>Prénoms :
                        </strong><span>.......................................................................</span></label>&nbsp;
                    &nbsp;
                    <label><strong>Né(e) le :
                        </strong><span>.......................................................</span></label>
                </div>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>1. Taille :
                        </strong><span>..........................M</span></label> &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <label><strong>2. Poids
                        </strong><span>................ KG</span></label>
                </div>

                <section style="width: 100%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 25%; float: left;"><strong>3. Fumez-vous ? :</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Oui</span>
                        </div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Non</span>
                        </div>
                        <div style="width: 45%; float: left;"><input type="radio" class="radio1"><span>Si Oui,
                                Nombre de cigarette par jour <strong> .........</strong></span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->

                </section>
                <section style="width: 90%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 30%; float: left;"><strong>4. Buvez-vous de l'alcool ? :</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Pas du
                                tout</span></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>À
                                l'occasion</span></div>
                        <div style="width: 55%; float: left;"><input type="radio"
                                class="radio1"><span>Régulièrement (Au moins une fois par semaine)</span></div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                </section>
                <div style="width: 100%; margin-top: 15px;">
                    <label><strong>5. Vos distractions :
                        </strong><span>.......................................................</span></label>
                </div>
                <section style="width: 85%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 50%; float: left;"><strong>6. Êtes-vous atteint d'une infirmité ? :</strong>
                        </div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Oui</span>
                        </div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Non</span>
                        </div>
                        <div style="width: 55%; float: left;"><input type="radio" class="radio1"><span>Si Oui,
                                Nature <strong>.....................</strong></span></div>
                    </div>

                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                    <div style="width: 100%; margin-left:50px;margin-top:5px">
                        <div style="width: 10%; float: left;"><strong>Cause :</strong></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Par
                                maladie</span></div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Par
                                accident</span></div>
                        <div style="width: 55%; float: left;"><input type="radio" class="radio1"><span>Autres :
                                <strong>...........................</strong></span>&nbsp; &nbsp;<span>La date :
                                <strong>...........................</strong></span></div>
                    </div>
                    <div style="clear: both;"></div>
                </section>
                <section style="width: 90%; margin: 5px 0; padding: 7px; border-radius: 7px;">

                    <div style="width: 100%;">
                        <div style="width: 33%; float: left;"><strong>7. Êtes-vous en arrêt de travail ? :</strong>
                        </div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Oui</span>
                        </div>
                        <div style="width: 18%; float: left;"><input type="radio" class="radio1"><span>Non</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
                    <div style="width: 100%; margin-left:50px;margin-top:5px">
                        <div style="width: 90%; float: left;"><span>Si Oui, depuis combien de temps ?
                                <strong>........</strong></span>&nbsp; &nbsp;<span>Motifs :
                                <strong>...........................</strong></span>&nbsp; &nbsp;<span>Date de reprise :
                                <strong>...........................</strong></span></div>
                    </div>
                    <div style="clear: both;"></div>
                </section>
                <table border="1" cellpadding="6" cellspacing="0" width="100%">
                    <tr>
                        <th>Nature</th>
                        <th>Reponse</th>
                        <th>Précisez</th>
                        <th>Date du traitement</th>
                        <th>Lieu du traitement</th>
                    </tr>
                    <tr>
                        <td>Avez-vous déjà été victime d'un accident ?</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Avez-vous déjà subit une tranfusion sanguine ?</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Avez-vous fait récemment l'objet d'un test de dépistage de l'hépartie B ?</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Avez-vous déjà subi des interventions churigicales ?</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Devez-vous subir des interventions churigicales ?</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: center">Êtes-vous sous traitement pour, ou soufrez-vous d'une de ces maladies ?</td>
                        
                    </tr>
                    <tr>
                        <td>Diabète</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Hypertension artérielle</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Drépanocytose</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Cirhose de foie</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Infection pulmonaire</td>
                        <td>Non</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table><br><br>
                <p>Je sousigné,certifie avoir repondu avec sincérité sans aucune reticence et n'avoir rein dissimulé sur
                    mon état de santé passé ou actuel et prend acte que toute reticence ou fausse déclaration de ma part
                    entrainera la nullité du contrat conformement à l'article 18 du Code CIMA.</p> <br><br>
            </div>
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
                    <div class="content1"
                        style="margin-top: 0px; padding: 5px; border: 1px solid #444; border-radius: 7px; background-color: #dbdbdb22">

                        <!-- Colonne gauche -->
                        <div style="width: 54%; float: left; padding: 7px 5px;">
                            <div class="nom" style="margin-bottom: 10px;">
                                <label><strong>Conseiller : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="Nom Prenoms"> </label>
                            </div>

                            <div class="birthday" style="margin-bottom: 10px;">
                                <label><strong>Unit Manager : </strong><input type="text"
                                        class="input-border-bottom" style="width: 76%" value="Unit Manager"> </label>
                            </div>

                            <div class="prenom" style="margin-bottom: 10px;">
                                <label><strong>Assistant Manager : </strong><input type="text"
                                        class="input-border-bottom" style="width: 67%" value="Assistant Manager">
                                </label>
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

        </section>
        <section style="width: 100%; margin-top: 20px;">
            <div style="width: 100%; margin-top: 10px; margin-bottom: 20px;">

                <label>Fait à <strong>................................................ </strong> le <strong>
                        ................................................</strong></label>
            </div>
            <div style="width: 100%; text-align: center;">
                <div style="width: 45%; float: left;">
                    <strong>Signature du souscripteur</strong>
                    <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p>
                    <div>
                        {{-- @if ($imageSrc != null)
                            <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 55px; height: 55px;">
                        @endif --}}
                    </div>
                </div>
                <div style="width: 45%; float: left;">
                    <strong>Signature de l'Assuré</strong>
                    <p><i style="font-size: 10px !important">(précédée de la mention "LU et APPROUVE)</i></p>
                </div>
            </div>
            <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
        </section>

        <section class="footer-fixed">

            <section style="border-bottom: 3px solid #ccc; margin-top: 40px">
                <div style="width: 100%;">
                    <div style="float: left;"><small style="font-size: 10px">Produit conçu et testé par la cellule
                            Recherche
                            & Développement de YAKO AFRICA Assurances Vie</small></div>
                </div>
                <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
            </section>
            <section style="padding: 0 25px; margin: 0 auto; margin-bottom: 20px">
                <div style="width: 100%; margin-bottom: 15px; margin-top: 5px">
                    <div style="float: left; text-align:center;">
                        <p>
                            <small>
                                Société Anonyme d'Assurance Vie au capital de 3 000 000 000 FCFA. Entreprise régie par
                                le
                                code des Assurances CIMA Siège social : Abidjan-Plateau - Immeuble woodin Center 4ème
                                étage
                                - Avenue Noguès 01 BP 11885 Abidjan 01
                            </small>
                        </p>
                        <p>
                            <small><strong>Tél.: (225) 27 20 22 94 64 / 27 20 33 15 00 - Fax : (225) 27 20 22 95 92 -
                                    RCC :
                                    CI-ABJ-03-2022-M-22882 </strong></small>
                        </p>
                        <p>
                            <small style="color: #656565">Email : infos@yakoafricassur.com - Site Web :
                                www.yakoafricassur.com</small>
                        </p>
                    </div>
                </div>
            </section>
        </section>


    </div>
</body>

</html>

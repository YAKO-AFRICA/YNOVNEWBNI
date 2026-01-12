DB::beginTransaction();
        try {
            // Gestion de la civilité pour l'adhérent et l'assuré
            $sexe = $request->civilite === "Monsieur" ? "M" : "F";
            $sexeassur = $request->civiliteAssur === "Monsieur" ? "M" : "F";
            $prime = $request->primepricipale + $request->surprime + $request->fraisadhesion;
            $datenaissance = Carbon::parse($request->datenaissance)->format('Y-m-d H:i:s');

            $age = Carbon::parse($datenaissance)->diffInYears(Carbon::now());



            // creation id 
            $idAdherent = Adherent::max('id') + 1;
            $idAssure = Assurer::max('id') + 1;
            $idBenef = Beneficiaire::max('id') + 1;
            $idContrat = Contrat::max('id') + 1;
            $idDocument = Document::max('id') + 1;


            $Adherent = Adherent::create([
                'id' => $idAdherent,
                'civilite' => $request->civilite,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'datenaissance' => $datenaissance,
                'lieunaissance' => $request->lieunaissance,
                'sexe' => $sexe,
                'numeropiece' => $request->numeropiece,
                'naturepiece' => $request->naturepiece,
                'lieuresidence' => $request->lieuresidence,
                'profession' => $request->profession,
                'employeur' => $request->employeur,
                'pays' => $request->pays,
                'estmigre' => 0,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'telephone1' => $request->telephone1,
                'mobile' => $request->mobile,
                'codemembre' => 0,
                'mobile1' => $request->mobile1,
                'saisieLe' => now(),
                'saisiepar' => Auth::user()->membre->idmembre,
                'refcontratsource' => $request->refcontratsource,
                'cleintegration' => $request->cleintegration,
                'id_maj' => $request->id_maj,
                'connexe' => $request->connexe,
                'contratconnexe' => $request->contratconnexe,
                'capitalconnexe' => $request->capitalconnexe
            ])->save();

            // Récupérer les assurés du formulaire

            $assures = json_decode($request->input('assures'), true);

            $garantiesRequises = ProduitGarantie::where(['codeproduit' => $request->codeproduit, 'estobligatoire' => 1, 'branche' => 'IND'])->get();
            Log::info("garanties requises  du produit " . $garantiesRequises);
            $GarantiesOptionnelles = ProduitGarantie::where(['codeproduit' => $request->codeproduit, 'estobligatoire' => 0, 'branche' => 'IND'])->get();

            // Log::info('assures dans le controller'. $assures);

            if ($request->estAssure === "Oui") {

                $Assurer = Assurer::create([
                    'id' => $idAssure,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'filiation' => "souscripteur",
                    'datenaissance' => $datenaissance,
                    'lieunaissance' => $request->lieunaissance,
                    'codecontrat' => $idContrat,
                    'codeadherent' => $idAdherent,
                    'sexe' => $sexe,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidence,
                    'profession' => $request->profession,
                    'employeur' => $request->employeur,
                    'pays' => $request->pays,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'telephone1' => $request->telephone1,
                    'mobile' => $request->mobile,
                    'codemembre' => 0,
                    'mobile1' => $request->mobile1,
                    'saisieLe' => now(),
                    'saisiepar' => auth::user()->membre->idmembre,
                ]);

                // foreach ($garantiesRequises as $garantie) {

                //     if ($Assurer) {
                //         AssureGarantie::create([
                //             'codeproduitgarantie' => $garantie->codeproduitgarantie,
                //             'idproduitparantie' => $garantie->id,
                //             'monlibelle' => $garantie->libelle,
                //             'prime' => $request->primepricipale,
                //             'primetotal' => $request->primepricipale,
                //             'primeaccesoire' => 0,
                //             'type' => "Mixte",
                //             'capitalgarantie' => $request->capital,
                //             'tauxinteret' => $request->tauxinteret,
                //             'codeassure' => $idAssureInsert,
                //             'codecontrat' => $idContrat,
                //             'refcontratsource' => '123456789',
                //             'estmigre' => 0,
                //         ])->save();
                //     }
                // }

                

                if ($request->codeproduit === "YKE_2018")
                {
                    $resultData = session()->get('simulation_primes');
                    Log::info("resultData",$resultData);

                    foreach ($resultData as $garantie) {

                        Log::info("garantie",$garantie);
                     
                        
                        if ($resultData) {
                            // Insérer dans la base de données
                            AssureGarantie::create([
                                'codeproduitgarantie' => $garantie['codeGarantie'],
                                'idproduitparantie'   => "100",
                                'monlibelle'          => $garantie['codeGarantie'],
                                'prime'               => $garantie['prime'],
                                'primetotal'          => $garantie['prime'],
                                'primeaccesoire'      => 0,
                                'type'                => "Mixte",
                                'capitalgarantie'     => $garantie['capitalSouscrit'],
                                'tauxinteret'         => $request->tauxinteret,
                                'codeassure'          => $idAssure,
                                'codecontrat'         => $idContrat,
                                'refcontratsource'    => 'qarty',
                                'estmigre'            => 0,
                            ]);
                        } else {
                            // Stocker l'erreur si l'API n'a pas retourné les données attendues
                            $results[$garantie->codeproduitgarantie] = [
                                'error'   => true,
                                'message' => 'Erreur lors de l\'appel API ou données manquantes'
                            ];
                        }
                    }
                    
                }else{
                    if ($request->has('GarantiesOptionnelles')) {
                        Log::info("Champs garanties optionnelles trouvées : ", $request->GarantiesOptionnelles);
                    } else {
                        Log::info("Champs garanties optionnelles non trouvées");
                    }

                    if ($request->has('GarantiesOptionnelles')) {
                        Log::info("Liste des garanties optionnelles:", $GarantiesOptionnelles->toArray());
                    
                        foreach ($request->GarantiesOptionnelles as $idGarantie => $value) {
                            Log::info("ID de la garantie : $idGarantie - Valeur: $value");

                            if ($value == "Oui") {
                                // Rechercher la garantie par son ID
                                $garantie = $GarantiesOptionnelles->firstWhere('id', $idGarantie);

                                $codeGarantie = $garantie->codeproduitgarantie;
                                $primeGarantie = 0;
                                if ($codeGarantie == "SUR") {
                                    $primeGarantie = 0;
                                }else{
                                    $primeGarantie = $request->primepricipale;
                                }
                    
                                if ($garantie) {
                                    Log::info("Garantie sélectionnée: ", (array) $garantie);
                    
                                    AssureGarantie::create([
                                        'codeproduitgarantie' => $garantie->codeproduitgarantie,
                                        'idproduitparantie' => $garantie->id,
                                        'monlibelle' => $garantie->libelle,
                                        'prime' => $primeGarantie,
                                        'primetotal' => $primeGarantie,
                                        'primeaccesoire' => 0,
                                        'type' => "Mixte",
                                        'capitalgarantie' => $request->capital,
                                        'tauxinteret' => $request->tauxinteret,
                                        'codeassure' => $idAssure,
                                        'codecontrat' => $idContrat,
                                        'refcontratsource' => 'qarty',
                                        'estmigre' => 0,
                                    ]);
                                } else {
                                    Log::warning("Aucune garantie trouvée pour l'ID : $idGarantie");
                                }
                            }
                        }
                    }
                    
                    foreach ($garantiesRequises as $garantie) {
                        $codeGarantie = $garantie->codeproduitgarantie;

                        $primeGarantie = 0;

                        if ($codeGarantie == "PERF") {
                            $primeGarantie = $request->garantiesperf;
                        }else if ($codeGarantie == "SECU") {
                            $primeGarantie = $request->garantiessecu;
                        }else{
                            $primeGarantie = $request->primepricipale;
                        }

                        Log::info("code garantie:". $primeGarantie);

                        AssureGarantie::create([
                            'codeproduitgarantie' => $garantie->codeproduitgarantie,
                            'idproduitparantie' => $garantie->id,
                            'monlibelle' => $garantie->libelle,
                            'prime' => $primeGarantie,
                            'primetotal' => $primeGarantie,
                            'primeaccesoire' => 0,
                            'type' => "Mixte",
                            'capitalgarantie' => $request->capital,
                            'tauxinteret' => $request->tauxinteret,
                            'codeassure' => $idAssure,
                            'codecontrat' => $idContrat,
                            'refcontratsource' => 'azerty',
                            'estmigre' => 0,
                        ])->save();
                    }
                }
            }

            if ($assures) {
                foreach ($assures as $assure) {
                    $datenaissanceAssur = isset($assure['datenaissance']) ? Carbon::parse($assure['datenaissance'])->format('Y-m-d H:i:s') : null;
                    $idAssureInsert = Assurer::max('id') + 1;

                    $sexeassurAdd = $assure['civilite'] === "Monsieur" ? "M" : "F";
                    Assurer::create([
                        'id' => $idAssureInsert,
                        'civilite' => $assure['civilite'],
                        'nom' => $assure['nom'],
                        'prenom' => $assure['prenom'],
                        'datenaissance' => $datenaissanceAssur,
                        'codecontrat' => $idContrat,
                        'codeadherent' => $idAdherent,
                        'lieunaissance' => $assure['lieuNaissance'],
                        'numeropiece' => $assure['numeropieceAssur'] ?? null,
                        'naturepiece' => $assure['naturepieceAssur'] ?? null,
                        'lieuresidence' => $assure['lieuresidenceAssur'] ?? null,
                        'filiation' => $assure['lienParente'],
                        'mobile' => $assure['mobileAssur'] ?? null,
                        'estmigre' => $request->estmigre ?? null,
                        'email' => $assure['emailAssur'] ?? null,
                        'sexe' => $sexeassurAdd,
                        'saisieLe' => now(),
                        'saisiepar' => Auth::user()->membre->idmembre,
                    ]);
                    // $idAssureInsert = ($Assurer)? $Assurer->id + 1 : Assurer::max('id') + 1;
                    foreach ($garantiesRequises as $garantie) {

                        AssureGarantie::create([
                            'codeproduitgarantie' => $garantie->codeproduitgarantie,
                            'idproduitparantie' => $garantie->id,
                            'monlibelle' => $garantie->libelle,
                            'prime' => $request->primepricipale,
                            'primetotal' => $request->primepricipale,
                            'primeaccesoire' => 0,
                            'type' => "Mixte",
                            'capitalgarantie' => $request->capital,
                            'tauxinteret' => $request->tauxinteret,
                            'codeassure' => $idAssureInsert,
                            'codecontrat' => $idContrat,
                            'refcontratsource' => '123456789',
                            'estmigre' => 0,
                        ])->save();
                    }
                }
            }

            $santeData = DeclarationSante::create([
                'taille' => $request->taille,
                'poids' => $request->poids,
                'tensionMin' => $request->tensionMin,
                'tensionMax' => $request->tensionMax,
                'smoking' => $request->smoking,
                'alcohol' => $request->alcohol,
                'sport' => $request->sport,
                'typeSport' => $request->typeSport,
                'accident' => $request->accident,
                'treatment' => $request->treatment, // trantement medical 6 dernier mois
                'transSang' => $request->transSang, // transfusion de sang 6 dernier mois
                'interChirugiale' => $request->interChirugiale, // intervention chirurgicaledeja subit
                'prochaineInterChirugiale' => $request->prochaineInterChirugiale, // intervention chirurgicale prochaine
                'diabetes' => $request->diabetes,
                'hypertension' => $request->hypertension,
                'sickleCell' => $request->sickleCell,
                'liverCirrhosis' => $request->liverCirrhosis,
                'lungDisease' => $request->lungDisease,
                'cancer' => $request->cancer,
                'anemia' => $request->anemia,
                'kidneyFailure' => $request->kidneyFailure,
                'stroke' => $request->stroke,
                'codeContrat' => $idContrat,
                'created_at' => now(),
            ]);


            // Récupérer et enregistrer les bénéficiaires
            $beneficiaires = json_decode($request->input('beneficiaires'), true);

            if ($request->addBeneficiary === "adherent") {
                $benefauterm = "adherent";
                $datenaissanceBenef = Carbon::parse($request->datenaissanceBenef)->format('Y-m-d H:i:s');

                Beneficiaire::create([
                    'id' => $idBenef,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $datenaissanceBenef,
                    'codecontrat' => $idContrat,
                    'codeadherent' => $idAdherent,
                    'lieunaissance' => $request->lieunaissance,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidence,
                    'filiation' => $request->lienParente,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                ])->save();
            }

            if ($beneficiaires) {

                foreach ($beneficiaires as $beneficiaire) {
                    $datenaissanceBeneficiaire = isset($beneficiaire['dateNaissance']) ? Carbon::parse($beneficiaire['dateNaissance'])->format('Y-m-d H:i:s') : null;
                    $idBenefInsert = Beneficiaire::max('id') + 1;
                    Beneficiaire::create([
                        'id' => $idBenefInsert,
                        'civilite' => $beneficiaire['civilite'] ?? null,
                        'nom' => $beneficiaire['nom'],
                        'prenom' => $beneficiaire['prenom'],
                        'datenaissance' => $datenaissanceBeneficiaire,
                        'codecontrat' => $idContrat,
                        'codeadherent' => $idAdherent,
                        'lieunaissance' => $beneficiaire['lieuNaissance'],
                        'numeropiece' => $beneficiaire['numeropiece'] ?? null,
                        'naturepiece' => $beneficiaire['naturepiece'] ?? null,
                        'lieuresidence' => $beneficiaire['lieuResidence'],
                        'filiation' => $beneficiaire['lienParente'],
                        'mobile' => $beneficiaire['telephone'],
                        'email' => $beneficiaire['email'],
                        'saisieLe' => now(),
                        'saisiepar' => Auth::user()->membre->idmembre,
                    ]);
                }
            }

            // ajout du contrat   numMobile  duree

            if ($request->modepaiement === "Mobile_money") {
                $numerocompte = $request->numMobile;
            } else {
                $numerocompte = $request->numerocompte;
            }
            $product = Product::where('CodeProduit', $request->codeproduit)->first();

            $contratData = Contrat::create([
                'id' => $idContrat,
                'dateeffet' => $request->dateEffet,
                'modepaiement' => $request->modepaiement,
                'organisme' => $request->organisme,
                'agence' => $request->agence,
                'numerocompte' => $numerocompte,
                'periodicite' => $request->periodicite,

                'codeConseiller' => Auth::user()->membre->codeagent,
                'nomagent' => Auth::user()->membre->nom . ' ' . Auth::user()->membre->prenom,

                'primepricipale' => number_format($request->primepricipale, 2, ".", ""),
                'prime' => $request->primepricipale,
                'fraisadhesion' => $request->fraisadhesion,

                'surprime' => $request->surprime,
                // 'capital' => $request->capital,
                'capital' => number_format($request->capital, 2, ".", ""),
                'etape' => 1,

                'saisiele' => now(),
                'saisiepar' => Auth::user()->membre->idmembre,

                'duree' => $request->duree,

                'codeadherent' => $idAdherent,
                'estMigre' => 0,
                'codeproduit' => $request->codeproduit,
                // 'numBullettin' => $numBullettin,

                // 'transmisle' => now(),
                // 'annulerle' => null,
                // 'accepterle' => null,
                // 'modifierle' => null,
                // 'modifierpar' => null,
                // 'motifrejet' => null,
                'libelleproduit' => $product->MonLibelle,
                'montantrente' => $request->montantrente,
                'periodiciterente' => $request->periodiciterente,
                'dureerente' => $request->dureerente,

                'personneressource' => $request->personneressource,
                'contactpersonneressource' => $request->contactpersonneressource,
                'beneficiaireauterme' => $benefauterm,
                'beneficiaireaudeces' => $request->audecesContrat,
                // 'accepterpar' => $idContrat,
                // 'rejeterpar' => $idAdherent,
                // 'transmispar' => $request->saisiepar,
                'personneressource2' => $request->personneressource2,
                'contactpersonneressource2' => $request->contactpersonneressource2,
                'codebanque' => $request->codebanque,
                'codeguichet' => $request->codeguichet,
                'rib' => $request->rib,
                // 'idproposition' => now(),
                // 'codeproposition' => now(),
                'branche' => Auth::user()->membre->branche,

                'partenaire' => Auth::user()->membre->partenaire,
                // 'nomaccepterpar' => now(),
                // 'refcontratsource' => now(),
                'cleintegration' => "19022025",
                // 'codeoperation' => now(),
                // 'numeropolice' => now(),

                'estpaye' => 0,
                // 'pretconnexe' => now(),
                // 'details' => now(),
                'nomsouscipteur' => $idAdherent,
                'typesouscipteur' => Auth::user()->membre->branche,
            ])->save();


            $bulletinData = $this->generateBulletin($idContrat);

            // Si la génération du bulletin a échoué, lever une exception
            if (!$bulletinData['success']) {
                throw new \Exception("Erreur lors de la génération du bulletin : " . $bulletinData['message']);
            }

            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => route('prod.edit', ['id' => $idContrat]),
                'url' => $bulletinData['file_url'],
                'message' => "Enregistré avec succès !",
                'code' => 200,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Erreur système: ", ['error' => $th]);
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
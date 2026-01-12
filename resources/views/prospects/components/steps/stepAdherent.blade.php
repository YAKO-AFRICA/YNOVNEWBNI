<!-- Step 2: Informations Personnelles et Contacts (MODERNISÉ) -->
<div class="form-grid">
    
    
    <div class="modern-form-grid">
        
        <!-- Section 1: Identité -->
        <div class="modern-form-section">
            <div class="section-header-modern">
                <div class="section-icon">
                    <i class="fadeIn animated bx bx-id-card text-light"></i>
                </div>
                <div class="section-title-content">
                    <h3>Informations Personnelles</h3>
                    <p class="section-subtitle">Informations d'identité du prospect</p>
                </div>
                <span class="section-badge badge-required">Requis</span>
            </div>
            
            <div class="row g-3 mt-3">
                <!-- Civilité - Cartes de sélection moderne -->
                <div class="col-12">
                    <label class="modern-label required">
                        <i class="fas fa-user-tie me-2"></i>Civilité
                        <span class="tooltip-icon-modern" data-bs-toggle="tooltip" title="Votre titre de civilité">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </label>
                    <div class="modern-cards-container">
                        <div class="modern-card-select" data-value="M" data-tooltip="Monsieur">
                            <div class="card-icon">
                                <i class="fadeIn animated bx bx-male"></i>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Monsieur</span>
                                <span class="card-subtitle">M.</span>
                            </div>
                            <input type="radio" name="civilite" value="M" required>
                        </div>
                        <div class="modern-card-select" data-value="Mme" data-tooltip="Madame">
                            <div class="card-icon">
                                <i class="fadeIn animated bx bx-female"></i>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Madame</span>
                                <span class="card-subtitle">Mme</span>
                            </div>
                            <input type="radio" name="civilite" value="Mme" required>
                        </div>
                        <div class="modern-card-select" data-value="Mme" data-tooltip="Mademoiselle">
                            <div class="card-icon">
                                <i class="fadeIn animated bx bx-female"></i>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Mademoiselle</span>
                                <span class="card-subtitle">Mlle</span>
                            </div>
                            <input type="radio" name="civilite" value="Mme" required>
                        </div>
                        <div class="modern-card-select" data-value="Dr" data-tooltip="Docteur">
                            <div class="card-icon">
                                <i class="fadeIn animated bx bx-medal"></i>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Docteur</span>
                                <span class="card-subtitle">Dr</span>
                            </div>
                            <input type="radio" name="civilite" value="Dr" required>
                        </div>
                        <div class="modern-card-select" data-value="Pr" data-tooltip="Président">
                            <div class="card-icon">
                                <i class="fadeIn animated bx bx-street-view"></i>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Président</span>
                                <span class="card-subtitle">Pr</span>
                            </div>
                            <input type="radio" name="civilite" value="Pr" required>
                        </div>
                    </div>
                </div>
                
                <!-- Nom et Prénom avec indicateurs -->
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label required">
                                Nom
                                <span class="required-dot"></span>
                            </label>
                            <input type="text" name="nom" class="modern-input" placeholder="Votre nom" required>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label required">
                                Prénom
                                <span class="required-dot"></span>
                            </label>
                            <input type="text" name="prenom" class="modern-input" placeholder="Votre prénom" required>
                        </div>
                    </div>
                </div>
                
                <!-- Genre - Cartes de sélection -->
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label class="modern-label">
                        <i class="fas fa-venus-mars me-2"></i>Genre
                    </label>

                    <div class="modern-cards-container compactt row">
                        <div class="modern-card-select col-6" data-value="M" data-tooltip="Masculin">
                            <div class="card-icon">
                                <i class="fadeIn animated bx bx-male"></i>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Masculin</span>
                            </div>
                            <input type="radio" name="genre" value="M">
                        </div>
                        <div class="modern-card-select col-6" data-value="F" data-tooltip="Féminin">
                            <div class="card-icon">
                                <i class="fadeIn animated bx bx-female"></i>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Féminin</span>
                            </div>
                            <input type="radio" name="genre" value="F">
                        </div>
                    </div>

                </div>
                
                <!-- Date et Lieu de Naissance -->
                <div class="row mt-4">
                    <div class="col-md-6 ">
                        <div class="modern-input-group">
                            <div class="input-icon-wrapper">
                                <i class="fas fa-birthday-cake"></i>
                            </div>
                            <div class="input-content">
                                <label class="input-label">Date de Naissance</label>
                                <input type="date" name="date_naissance" class="modern-input">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="modern-input-group">
                            <div class="input-icon-wrapper">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="input-content">
                                <label class="input-label">Lieu de Naissance</label>
                                <select name="lieu_naissance" class="modern-select selection">
                                    <option value="" disabled selected>Sélectionner une ville</option>
                                    @foreach ($villes as $ville)
                                        <option value="{{ $ville['CodeVille'] }}">{{ $ville['MonLibelle'] ?? ' ' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section 2: Résidence et Situation -->
        <div class="modern-form-section">
            <div class="section-header-modern">
                <div class="section-icon">
                    <i class="bx bx-home"></i>
                </div>
                <div class="section-title-content">
                    <h3>Résidence et Situation</h3>
                    <p class="section-subtitle">Adresse et situation familiale</p>
                </div>
            </div>
            
            <div class="row g-3 mt-3">
                <!-- Pays et Ville -->
                <div class="col-md-6">
                    <div class="modern-input-group">
                        {{-- <div class="input-icon-wrapper">
                            <i class="bx bx-globe"></i>
                        </div> --}}
                        <div class="input-content">
                            <label class="input-label">Pays de résidence</label>
                            <select name="pays" class="modern-select selection" id="pays">
                                <option value="" disabled selected>Sélectionner un pays</option>
                                @foreach ($pays as $item)
                                    <option value="{{ $item['nameFr'] }}" data-code="{{ $item['code']}}">
                                        {{ $item['nameFr'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="modern-input-group">
                        {{-- <div class="input-icon-wrapper">
                            <i class="bx bx-city"></i>
                        </div> --}}
                        <div class="input-content">
                            <label class="input-label">Ville de Résidence</label>
                            <select name="lieu_residence" class="modern-select selection">
                                <option value="" disabled selected>Sélectionner une ville</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville['CodeVille'] }}">{{ $ville['MonLibelle'] ?? ' ' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Situation Matrimoniale - Cartes de sélection -->
                <div class="col-12">
                    <label class="modern-label">
                        <i class="fas fa-heart me-2"></i>Situation Matrimoniale
                        <span class="tooltip-icon-modern" data-bs-toggle="tooltip" title="Votre situation familiale">
                            <i class="bx bx-info-circle"></i>
                        </span>
                    </label>
                    <div class="modern-cards-container compact">
                        <div class="modern-card-select" data-value="CELIB" data-tooltip="Célibataire">
                            {{-- <div class="card-icon">
                                <i class="fas fa-user"></i>
                            </div> --}}
                            <div class="card-content">
                                <span class="card-title">Célibataire</span>
                            </div>
                            <input type="radio" name="situation_matrimoniale" value="CELIB">
                        </div>
                        <div class="modern-card-select" data-value="MARIE" data-tooltip="Marié(e)">
                            {{-- <div class="card-icon">
                                <i class="bx bx-ring"></i>
                            </div> --}}
                            <div class="card-content">
                                <span class="card-title">Marié(e)</span>
                            </div>
                            <input type="radio" name="situation_matrimoniale" value="MARIE">
                        </div>
                        <div class="modern-card-select" data-value="DIVOR" data-tooltip="Divorcé(e)">
                            {{-- <div class="card-icon">
                                <i class="fas fa-user-times"></i>
                            </div> --}}
                            <div class="card-content">
                                <span class="card-title">Divorcé(e)</span>
                            </div>
                            <input type="radio" name="situation_matrimoniale" value="DIVOR">
                        </div>
                        <div class="modern-card-select" data-value="VEUVE" data-tooltip="Veuf(ve)">
                            {{-- <div class="card-icon">
                                <i class="fas fa-user-alt-slash"></i>
                            </div> --}}
                            <div class="card-content">
                                <span class="card-title">Veuf(ve)</span>
                            </div>
                            <input type="radio" name="situation_matrimoniale" value="VEUVE">
                        </div>
                        <div class="modern-card-select" data-value="CONCUB" data-tooltip="Concubinage">
                            {{-- <div class="card-icon">
                                <i class="fas fa-user-friends"></i>
                            </div> --}}
                            <div class="card-content">
                                <span class="card-title">Concubinage</span>
                            </div>
                            <input type="radio" name="situation_matrimoniale" value="CONCUB">
                        </div>
                    </div>
                </div>
                
                <!-- Adresse -->
                <div class="col-12">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-address-card"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label">Adresse Complète</label>
                            <textarea name="adresse" class="modern-textarea" rows="2" placeholder="Votre adresse complète"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section 3: Pièce d'Identité -->
        <div class="modern-form-section">
            <div class="section-header-modern">
                <div class="section-icon">
                    <i class="fadeIn animated bx bx-credit-card-front"></i>
                </div>
                <div class="section-title-content">
                    <h3>Pièce d'Identité</h3>
                    <p class="section-subtitle">Document d'identification officiel</p>
                </div>
            </div>
            
            <div class="row g-3 mt-3">
                <!-- Type Pièce - Cartes de sélection -->
                <div class="col-12">
                    <label class="modern-label">
                        <i class="fas fa-id-card me-2"></i>Type de Pièce
                    </label>
                    <div class="modern-cards-container compact">
                        <div class="modern-card-select" data-value="CNI" data-tooltip="Carte Nationale d'Identité">

                            <div class="card-content">
                                <span class="card-title">CNI</span>
                                <span class="card-subtitle">Carte d'identité</span>
                            </div>
                            <input type="radio" name="type_piece_identite" value="CNI">
                        </div>
                        <div class="modern-card-select" data-value="Passeport" data-tooltip="Passeport">

                            <div class="card-content">
                                <span class="card-title">Passeport</span>
                                <span class="card-subtitle">Document</span>
                            </div>
                            <input type="radio" name="type_piece_identite" value="Passeport">
                        </div>
                        <div class="modern-card-select" data-value="Permis de conduire" data-tooltip="Permis de conduire">

                            <div class="card-content">
                                <span class="card-title">Permis</span>
                                <span class="card-subtitle">Conduire</span>
                            </div>
                            <input type="radio" name="type_piece_identite" value="Permis de conduire">
                        </div>
                        <div class="modern-card-select" data-value="Attestation" data-tooltip="Attestation d'identité">

                            <div class="card-content">
                                <span class="card-title">Attestation</span>
                                <span class="card-subtitle">Identité</span>
                            </div>
                            <input type="radio" name="type_piece_identite" value="Attestation">
                        </div>
                        <div class="modern-card-select" data-value="carte_consulaire" data-tooltip="Carte Consulaire">

                            <div class="card-content">
                                <span class="card-title">Consulaire</span>
                                <span class="card-subtitle">Carte</span>
                            </div>
                            <input type="radio" name="type_piece_identite" value="carte_consulaire">
                        </div>
                    </div>
                </div>
                
                <!-- Numéro Pièce et Email -->
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label">Numéro de Pièce</label>
                            <input type="text" name="numero_piece_identite" class="modern-input" placeholder="N° de document">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label">Email</label>
                            <input type="email" name="email" class="modern-input" placeholder="email@exemple.com">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section 4: Profession -->
        <div class="modern-form-section">
            <div class="section-header-modern">
                <div class="section-icon">
                    <i class="lni lni-atlassian"></i>
                </div>
                <div class="section-title-content">
                    <h3>Profession</h3>
                    <p class="section-subtitle">Activité professionnelle</p>
                </div>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label">Profession</label>
                            <select name="profession" class="modern-select selection" id="profession">
                                <option value="" disabled selected>Sélectionner une profession</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label">Secteur d'Activité</label>
                            <select name="employeur" class="modern-select selection" id="employeur">
                                <option value="" disabled selected>Sélectionner un secteur</option>
                                @foreach($secteurActivites as $secteurActivite)
                                    <option value="{{ $secteurActivite->MonLibelle }}">
                                        {{ $secteurActivite->MonLibelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contacts du Prospect -->
    <div class="contacts-section-modern">
        <div class="section-header-modern">
            <div class="section-icon">
                <i class="fadeIn animated bx bx-phone-incoming"></i>
            </div>
            <div class="section-title-content">
                <h3>📞 Contacts du Prospect</h3>
                <p class="section-subtitle">Ajoutez tous les moyens de contact</p>
            </div>
        </div>
        
        <div class="info-box-modern">
            <i class="fas fa-info-circle"></i>
            <p>Ajoutez tous les numéros de téléphone et moyens de contact du prospect (fixe, mobile, etc.)</p>
        </div>
        
        <button type="button" class="btn-modern btn-primary-modern" onclick="openContactModal()">
            <i class="fas fa-plus"></i>
            Ajouter un Contact
        </button>
        
        <div id="contactsList" class="contacts-grid-modern mt-4"></div>
    </div>
        
        
        
        <!-- Section 6: Contacts d'Urgence -->
        <div class="modern-form-section warning">
            <div class="section-header-modern">
                <div class="section-icon">
                    <i class="fadeIn animated bx bx-phone text-warning"></i>
                </div>
                <div class="section-title-content">
                    <h3>Contacts d'Urgence</h3>
                    <p class="section-subtitle">Personnes à contacter en cas de besoin</p>
                </div>
                <span class="section-badge badge-danger">Requis</span>
            </div>
            
            <div class="row g-3 mt-3">
                <!-- Contact 1 -->
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label required">
                                Personne Ressource 1
                                <span class="required-dot"></span>
                            </label>
                            <input type="text" name="personneRessource" class="modern-input" 
                                   placeholder="Nom et prénom" required>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="modern-input-group with-indicator">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label required">
                                Contact 1
                                <span class="required-dot"></span>
                                <span class="tooltip-icon-modern" data-bs-toggle="tooltip" 
                                      title="Format: 10 à 14 chiffres (ex: 771234567)">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </label>
                            <input type="tel" name="contactRessource" class="modern-input phone-input" 
                                   placeholder="771234567" 
                                   minlength="10" maxlength="14" 
                                   pattern="^[0-9]+$" required>
                            <div class="phone-indicator">
                                <i class="fas fa-check valid-icon"></i>
                                <i class="fas fa-times invalid-icon"></i>
                            </div>
                        </div>
                        <div class="input-hint">Format: 10-14 chiffres</div>
                    </div>
                </div>
                
                <!-- Contact 2 -->
                <div class="col-md-6">
                    <div class="modern-input-group">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label">Personne Ressource 2</label>
                            <input type="text" name="personneRessource2" class="modern-input" 
                                   placeholder="Nom et prénom">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="modern-input-group with-indicator">
                        <div class="input-icon-wrapper">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="input-content">
                            <label class="input-label">Contact 2</label>
                            <input type="tel" name="contactRessource2" class="modern-input phone-input" 
                                   placeholder="771234567" 
                                   minlength="10" maxlength="14" 
                                   pattern="^[0-9]+$">
                            <div class="phone-indicator">
                                <i class="fas fa-check valid-icon"></i>
                                <i class="fas fa-times invalid-icon"></i>
                            </div>
                        </div>
                        <div class="input-hint">Format: 10-14 chiffres</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section 7: Notes -->
        <div class="modern-form-section">
            <div class="section-header-modern">
                <div class="section-icon">
                    <i class="fadeIn animated bx bx-note"></i>
                </div>
                <div class="section-title-content">
                    <h3>Notes Complémentaires</h3>
                    <p class="section-subtitle">Informations supplémentaires</p>
                </div>
            </div>
            
            <div class="modern-input-group mt-3">
                <div class="input-icon-wrapper">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="input-content">
                    <textarea name="notes" class="modern-textarea" rows="3" 
                              placeholder="Ajoutez ici toute information complémentaire, remarque ou précision..."></textarea>
                </div>
            </div>
        </div>
    </div>
    
    

    <!-- Section 5: Agent Commercial -->
        <div class="modern-form-section highlight">
            <div class="section-header-modern">
                <div class="section-icon">
                    <i class="lni lni-network"></i>
                </div>
                <div class="section-title-content">
                    <h3>Agent Commercial</h3>
                    <p class="section-subtitle">Votre conseiller YAKO AFRICA</p>
                </div>
                <span class="section-badge badge-success">Pré-rempli</span>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="info-display-modern">
                        <div class="info-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Agent Commercial</span>
                            <span class="info-value">
                                {{ $commerciale->membre->nom ?? '' }} {{ $commerciale->membre->prenom ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="info-display-modern">
                        <div class="info-icon">
                            <i class="bx b-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Téléphone Commercial</span>
                            <span class="info-value">
                                {{ $commerciale->membre->cel ?? $commerciale->membre->tel ?? '' }}
                                @if($commerciale->membre->cel)
                                    <span class="phone-type-badge mobile">Mobile</span>
                                @elseif($commerciale->membre->tel)
                                    <span class="phone-type-badge fixe">Fixe</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- Styles CSS -->
<style>
    .modern-form-grid {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .modern-form-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #eef2f7;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .modern-form-section:hover {
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    
    .modern-form-section.highlight {
        border-left: 5px solid #134723FF;
        background: linear-gradient(135deg, #f8fafe 0%, #f0f4ff 100%);
    }
    
    .modern-form-section.warning {
        border-left: 5px solid #ff6b6b;
        background: linear-gradient(135deg, #fff5f5 0%, #ffeaea 100%);
    }
    
    /* Section Header */
    .section-header-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f4f8;
    }
    
    .section-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #134723FF, #134723FF);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }
    
    .section-title-content {
        flex: 1;
    }
    
    .section-title-content h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
    }
    
    .section-subtitle {
        margin: 0;
        font-size: 0.875rem;
        color: #718096;
        margin-top: 0.25rem;
    }
    
    /* Badges */
    .section-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .badge-required {
        background: #ff6b6b;
        color: white;
    }
    
    .badge-success {
        background: #06d6a0;
        color: white;
    }
    
    .badge-danger {
        background: #ff6b6b;
        color: white;
    }
    
    /* Labels */
    .modern-label {
        display: flex;
        align-items: center;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #4a5568;
        font-size: 0.95rem;
    }
    
    .modern-label.required::after {
        content: " *";
        color: #ff6b6b;
        font-weight: bold;
    }
    
    .tooltip-icon-modern {
        margin-left: 0.5rem;
        color: #a0aec0;
        cursor: help;
        font-size: 0.875rem;
    }
    
    /* Cartes de sélection */
    .modern-cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 0.75rem;
        margin-top: 0.5rem;
    }
    
    .modern-cards-container.compact {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
    
    .modern-card-select {
        position: relative;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        user-select: none;
        overflow: hidden;
    }
    
    .modern-card-select:hover {
        border-color: #cbd5e0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .modern-card-select.selected {
        background: #e6f7ff;
        border-color: #134723FF;
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.15);
    }
    
    .modern-card-select input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .card-icon {
        width: 36px;
        height: 36px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #718096;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .modern-card-select.selected .card-icon {
        background: #134723FF;
        color: white;
    }
    
    .card-content {
        flex: 1;
        min-width: 0;
    }
    
    .card-title {
        display: block;
        font-weight: 500;
        font-size: 0.875rem;
        color: #4a5568;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .modern-card-select.selected .card-title {
        color: #134723FF;
        font-weight: 600;
    }
    
    .card-subtitle {
        display: block;
        font-size: 0.75rem;
        color: #a0aec0;
        margin-top: 0.125rem;
    }
    
    /* Input Groups */
    .modern-input-group {
        position: relative;
        margin-bottom: 1rem;
    }
    
    .modern-input-group.with-indicator {
        margin-bottom: 1.5rem;
    }
    
    .input-icon-wrapper {
        position: absolute;
        left: 1rem;
        top: 0.75rem;
        color: #a0aec0;
        z-index: 10;
        pointer-events: none;
    }
    
    .input-content {
        position: relative;
    }
    
    .input-label {
        display: block;
        font-weight: 500;
        font-size: 0.9rem;
        color: #4a5568;
        margin-bottom: 0.375rem;
    }
    
    .input-label.required {
        display: flex;
        align-items: center;
    }
    
    .required-dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        background: #ff6b6b;
        border-radius: 50%;
        margin-left: 0.25rem;
    }
    
    .modern-input, .modern-select, .modern-textarea {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        color: #4a5568;
        background: white;
        transition: all 0.2s ease;
    }
    
    .modern-input:focus, .modern-select:focus, .modern-textarea:focus {
        outline: none;
        border-color: #134723FF;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }
    
    .modern-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    /* Phone Input Indicators */
    .phone-input {
        padding-right: 3.5rem;
    }
    
    .phone-indicator {
        position: absolute;
        right: 1rem;
        top: 2.6rem;
        transform: translateY(-50%);
        font-size: 1.25rem;
        opacity: 0.8;
    }
    
    .valid-icon, .invalid-icon {
        display: none;
    }
    
    .phone-input:valid + .phone-indicator .valid-icon {
        display: block;
        color: #06d6a0;
    }
    
    .phone-input:invalid:not(:placeholder-shown) + .phone-indicator .invalid-icon {
        display: block;
        color: #ff6b6b;
    }
    
    .input-hint {
        font-size: 0.75rem;
        color: #a0aec0;
        margin-top: 0.25rem;
        margin-left: 0.25rem;
    }
    
    /* Info Display */
    .info-display-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    
    .info-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #134723FF;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    
    .info-content {
        flex: 1;
    }
    
    .info-label {
        display: block;
        font-size: 0.8rem;
        color: #718096;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        display: block;
        font-weight: 600;
        color: #2d3748;
        font-size: 1rem;
    }
    
    .phone-type-badge {
        display: inline-block;
        padding: 0.125rem 0.5rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-left: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .phone-type-badge.mobile {
        background: #dbeafe;
        color: #134723FF;
    }
    
    .phone-type-badge.fixe {
        background: #fce7f3;
        color: #9d174d;
    }
    
    /* Contacts Section */
    .contacts-section-modern {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #eef2f7;
    }
    
    .info-box-modern {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: #f0f9ff;
        border-radius: 10px;
        border: 1px solid #bae6fd;
        margin: 1rem 0;
    }
    
    .info-box-modern i {
        color: #0ea5e9;
        font-size: 1.25rem;
        margin-top: 0.125rem;
    }
    
    .info-box-modern p {
        margin: 0;
        color: #134723FF;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .btn-modern {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, #134723FF, #134723FF);
        color: white;
    }
    
    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.3);
    }
    
    .contacts-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .modern-cards-container {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .modern-cards-container.compact {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .contacts-grid-modern {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .modern-cards-container,
        .modern-cards-container.compact {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Scripts JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les tooltips Bootstrap
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
    
    // Gestion des cartes de sélection
    document.querySelectorAll('.modern-card-select').forEach(card => {
        card.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            const name = radio.name;
            const container = this.closest('.modern-cards-container');
            
            // Désélectionner toutes les cartes du même groupe
            container.querySelectorAll('.modern-card-select').forEach(c => {
                c.classList.remove('selected');
            });
            
            // Sélectionner la carte cliquée
            this.classList.add('selected');
            radio.checked = true;
            
            // Déclencher l'événement change
            radio.dispatchEvent(new Event('change'));
        });
        
        // Afficher le tooltip personnalisé au survol
        card.addEventListener('mouseenter', function() {
            const tooltipText = this.getAttribute('data-tooltip');
            if (tooltipText) {
                this.setAttribute('title', tooltipText);
            }
        });
    });
    
    // Validation des numéros de téléphone
    document.querySelectorAll('.phone-input').forEach(input => {
        const indicator = input.parentElement.parentElement.querySelector('.phone-indicator');
        
        input.addEventListener('input', function() {
            const value = this.value.trim();
            const isValid = /^[0-9]{10,14}$/.test(value);
            
            // Mettre à jour visuellement la validité
            if (value === '') {
                this.classList.remove('is-valid', 'is-invalid');
            } else if (isValid) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
            
            // Mettre à jour l'indicateur
            if (indicator) {
                const validIcon = indicator.querySelector('.valid-icon');
                const invalidIcon = indicator.querySelector('.invalid-icon');
                
                if (value === '') {
                    validIcon.style.display = 'none';
                    invalidIcon.style.display = 'none';
                } else if (isValid) {
                    validIcon.style.display = 'block';
                    invalidIcon.style.display = 'none';
                } else {
                    validIcon.style.display = 'none';
                    invalidIcon.style.display = 'block';
                }
            }
        });
        
        // Validation au blur
        input.addEventListener('blur', function() {
            const value = this.value.trim();
            const isValid = /^[0-9]{10,14}$/.test(value);
            
            if (value !== '' && !isValid) {
                // Afficher un message d'erreur
                const hint = this.closest('.modern-input-group').querySelector('.input-hint');
                if (hint) {
                    hint.style.color = '#ff6b6b';
                    hint.textContent = 'Format invalide (10-14 chiffres requis)';
                }
            } else {
                const hint = this.closest('.modern-input-group').querySelector('.input-hint');
                if (hint) {
                    hint.style.color = '#a0aec0';
                    hint.textContent = 'Format: 10-14 chiffres';
                }
            }
        });
    });
    
    // Pré-sélectionner la première option des cartes de sélection
    document.querySelectorAll('.modern-cards-container').forEach(container => {
        const firstCard = container.querySelector('.modern-card-select');
        if (firstCard) {
            firstCard.classList.add('selected');
            const radio = firstCard.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
        }
    });
});
</script>
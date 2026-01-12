<div class="info-box">
    <p>📎 Téléchargez les documents nécessaires (pièces d'identité, justificatifs, etc.)</p>
</div>

<div class="form-group mb-4">
    <label>Type de Document</label>
    <select id="documentNature">
        <option value="">Sélectionner</option>
        <option value="piece_identite">Pièce d'identité</option>
        <option value="justificatif_domicile">Justificatif de domicile</option>
        <option value="bulletin_salaire">Bulletin de salaire</option>
        <option value="attestation_travail">Attestation de travail</option>
        <option value="autre">Autre</option>
    </select>
</div>

<div class="file-upload-area" onclick="document.getElementById('fileInput').click()">
    <p>📁 Cliquez pour sélectionner un fichier</p>
    <small style="color: #666;">PDF, JPG, PNG (Max 5MB)</small>
    <input type="file" id="fileInput" style="display: none;" accept=".pdf,.jpg,.jpeg,.png"
        onchange="handleFileSelect(event)">
</div>

<div id="filesList" class="file-list"></div>

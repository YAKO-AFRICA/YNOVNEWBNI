<div id="contactModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Ajouter un Contact</h2>
            <button type="button" class="close-modal" onclick="closeContactModal()">×</button>
        </div>
        <div class="modal-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="required">Type de Contact</label>
                    <select id="contactType" >
                        <option value="">Sélectionner</option>
                        <option value="mobile">Mobile</option>
                        <option value="fixe">Téléphone fixe</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="email">Email</option>
                        <option value="Wave">Wave</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="required">Contact</label>
                    <input type="tel" id="contactValue" class="form-control" placeholder="Entrez le contact" maxlength="14" min="10">
                </div>
            </div>
            <div style="margin-top: 20px; text-align: right;">
                <button type="button" class="btn btn-secondary" onclick="closeContactModal()"
                    style="margin-right: 10px;">
                    Annuler
                </button>
                <button type="button" class="btn btn-primary" onclick="addContact()">
                    Ajouter
                </button>
            </div>
        </div>
    </div>
</div>

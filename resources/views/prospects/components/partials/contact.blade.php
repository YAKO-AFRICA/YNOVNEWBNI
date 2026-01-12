<div class="form-grid row">
    <div class="form-group col-sm-12 col-md-8 col-lg-6">
        <label class="required">Type de Contact</label>
        <div class="row gap-2">
            <label for="mobile" class="col-3">
                <input type="checkbox" name="contactType[]" value="mobile" id="mobile">
                <span>Mobile</span>
            </label>
            <label for="fixe" class="col-3">
                <input type="checkbox" name="contactType[]" value="fixe" id="fixe">
                <span>Fixe</span>
            </label>
            <label for="whatsapp" class="col-3">
                <input type="checkbox" name="contactType[]" value="whatsapp" id="whatsapp">
                <span>WhatsApp</span>
            </label>
            <label for="Wave" class="col-3">
                <input type="checkbox" name="contactType[]" value="Wave" id="Wave">
                <span>Wave</span>
            </label>
            <label for="autre" class="col-3">
                <input type="checkbox" name="contactType[]" value="autre" id="autre">
                <span>Autre</span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12 col-md-4 col-lg-4 mb-2">
        <label class="required">Contact</label>
        <input type="tel" id="contactValue" class="form-control" required placeholder="Entrez le contact" maxlength="14" min="10" required>
    </div>
</div>

<button type="button" class="btn btn-primary" onclick="openContactModal()">
    + Ajouter un Contact
</button>

<div id="contactsList" class="added-list"></div>

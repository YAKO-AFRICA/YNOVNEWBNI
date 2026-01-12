<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits d'Assurance</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        /* Banner Section */
        .banner {
            background: linear-gradient(135deg, rgba(7, 102, 51, 0.9), rgba(237, 180, 64, 0.8)), 
                        url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .banner-content h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }

        .banner-content p {
            font-size: 1.3rem;
            max-width: 600px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .main-content {
            padding: 60px 0;
        }

        /* Products Grid */
        .products-section {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .products-list {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .products-list h2 {
            color: #076633;
            margin-bottom: 25px;
            font-size: 1.8rem;
            border-bottom: 3px solid #edb440;
            padding-bottom: 10px;
        }

        .product-card {
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .product-card:hover {
            border-color: #edb440;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(237, 180, 64, 0.3);
        }

        .product-card.active {
            border-color: #076633;
            background: linear-gradient(135deg, #076633, #0a7d3d);
            color: white;
        }

        .product-card h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: inherit;
        }

        .product-code {
            font-size: 0.9rem;
            opacity: 0.8;
            font-weight: bold;
        }

        .product-status {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #edb440;
            color: #076633;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        /* Product Details */
        .product-details {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            min-height: 500px;
        }

        .product-details.empty {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-style: italic;
        }

        .detail-header {
            border-bottom: 3px solid #edb440;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .detail-header h2 {
            color: #076633;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .detail-header .product-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            border: 1px solid #edb440;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #076633;
        }

        .detail-item label {
            font-weight: bold;
            color: #076633;
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .detail-item span {
            color: #333;
            font-size: 1rem;
        }

        /* Subscribe Section */
        .subscribe-section {
            margin-top: 40px;
            padding: 30px;
            background: linear-gradient(135deg, #076633, #0a7d3d);
            border-radius: 15px;
            color: white;
            text-align: center;
        }

        .privacy-check {
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .privacy-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #edb440;
        }

        .privacy-check label {
            font-size: 0.9rem;
            cursor: pointer;
        }

        .subscribe-btn {
            background: #edb440;
            color: #076633;
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            disabled: opacity 0.5;
        }

        .subscribe-btn:hover:not(:disabled) {
            background: #d4a136;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(237, 180, 64, 0.4);
        }

        .subscribe-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .products-section {
                grid-template-columns: 1fr;
            }
            
            .banner-content h1 {
                font-size: 2.5rem;
            }
            
            .banner-content p {
                font-size: 1.1rem;
            }
            
            .product-details {
                padding: 20px;
            }
            
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-content">
            <h1>Nos Produits d'Assurance</h1>
            <p>Découvrez notre gamme complète de produits d'assurance conçus pour vous protéger et sécuriser votre avenir</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="main-content">
            <div class="products-section">
                <!-- Products List -->
                <div class="products-list">
                    <h2>Nos Produits</h2>
                    <div id="products-container">
                        <!-- Products will be loaded here -->
                    </div>
                </div>

                <!-- Product Details -->
                <div class="product-details empty" id="product-details">
                    <p>Sélectionnez un produit pour voir les détails</p>
                </div>
            </div>
        </div>
    </div>



    <script>
        const products = @json($products);
        const user = @json($user);

        console.log('User:', user['codepartenaire']);

        let selectedProduct = null;
        let privacyAccepted = false;

        let ageMax = 0;
        let LibProduit = "";
        if (user['codepartenaire'] === "DIASPORA") {
            ageMax = 80;
            LibProduit = "YAKO OBSEQUE DIASPORA";
        }else if (user['codepartenaire'] === "DIRECTENTREPRISE") {
            ageMax = 50;
            LibProduit = "YAKO SOUTIEN FIDEL";
        }
        else{
            ageMax = 64;
            LibProduit = "YAKO FRAIE FUNERAIRE";
        }

        function renderProducts() {
            const container = document.getElementById('products-container');
            container.innerHTML = '';

            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card';
                productCard.onclick = (event) => selectProduct(product, event);


                productCard.innerHTML = `
                    <h3>${LibProduit}</h3>
                `;
                
                
                container.appendChild(productCard);
            });

            // Sélectionner par défaut le premier produit
            if (products.length > 0) {
                selectProduct(products[0], container.firstChild);
            }
        }

        function selectProduct(product, elementOrEvent) {
            selectedProduct = product;

            // Mise à jour de l'état actif
            document.querySelectorAll('.product-card').forEach(card => {
                card.classList.remove('active');
            });

            if (elementOrEvent instanceof Event) {
                elementOrEvent.target.closest('.product-card').classList.add('active');
            } else if (elementOrEvent instanceof HTMLElement) {
                elementOrEvent.classList.add('active');
            }

            // Afficher les détails du produit
            renderProductDetails(product);
        }


        function renderProductDetails(product) {
            const detailsContainer = document.getElementById('product-details');
            detailsContainer.className = 'product-details';
            
            detailsContainer.innerHTML = `
                <div class="detail-header">
                    <h2>${LibProduit}</h2>
                    <div class="product-meta">
                        <span class="meta-item">Code: ${product.CodeProduit}</span>
                        <span class="meta-item">Âge Minimum: ${product.AgeMiniAdh}</span>

                        <span class="meta-item">Âge Maximum: ${ageMax}</span>
                    </div>
                </div>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Informations sur le produit</label>
                        <span>
                            Les funérailles peuvent représenter un lourd fardeau financier, vous laissant démunis face à cette épreuve. 
                            Avec <strong>${LibProduit}</strong>, vous bénéficiez de l’accompagnement et du soutien de <strong>YAKO AFRICA Assurances Vie</strong> 
                            pour organiser sereinement les obsèques de vos proches disparus.  
                            <br><br>
                            Vous n’êtes plus seuls : nous sommes à vos côtés pour vous apporter assistance, réconfort et sérénité dans ces moments difficiles.
                        </span>
                    </div>
                </div>

                
                <div class="subscribe-section">
                    <h3>Souscription au Produit</h3>
                    <p>Protégez-vous dès maintenant avec ce produit d'assurance adapté à vos besoins.</p>
                    
                    <div class="privacy-check">
                        <input type="checkbox" id="cgu-checkbox" onchange="togglePrivacy()">
                        <label for="cgu-checkbox">
                            J’ai lu et compris les 
                            <a href="" onclick="window.open('{{ asset('root/cgu/CGsoutienFidel.pdf') }}')" style="color: #edb440;">conditions générales</a>
                        </label>
                    </div>

                    <div class="privacy-check">
                        <input type="checkbox" id="confidentialite-checkbox" onchange="togglePrivacy()">
                        <label for="confidentialite-checkbox">
                            J’accepte la 
                            <a href="https://yakoafricassur.com/politique/confident.html" target="_blank" style="color: #edb440;">politique de confidentialité</a>
                        </label>
                    </div>
                    
                    <button class="subscribe-btn" id="subscribe-btn" onclick="subscribe()" disabled>
                        Souscrire au Produit
                    </button>
                </div>
            `;
        }


        function togglePrivacy() {
            privacyAccepted = document.getElementById('confidentialite-checkbox').checked;
            cguAccepted = document.getElementById('cgu-checkbox').checked;
            const subscribeBtn = document.getElementById('subscribe-btn');
            subscribeBtn.disabled = !privacyAccepted || !cguAccepted;
        }

        const userData = @json($user);
        const userCode = userData['codepartenaire'];



        function subscribe() {
            if (!selectedProduct || !privacyAccepted || !cguAccepted) {
                swal.fire({
                    icon: 'warning',
                    title: 'Veuillez accepter les conditions generales et la politique de confidentialite',
                    showConfirmButton: true
                })
                return;
            }

            if(!userData && userCode === "DIASPORA")
            {
                window.location.href = '/site/simulateurPrimeDia/'+selectedProduct.CodeProduit + '/' + user.idmembre;
            } else if(userCode === "DIRECTENTREPRISE")
            
            {
                window.location.href = '/site/simulateurPrimeDirectE/'+selectedProduct.CodeProduit + '/' + user.idmembre;
            } else {
                window.location.href = '/site/simulateurPrimeDia/'+selectedProduct.CodeProduit + '/' + user.idmembre;
            }
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderProducts();
        });

    
     </script>
</body>


</html>
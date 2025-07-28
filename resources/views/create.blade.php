@extends('template')

<style>
    .password-generator-container {
        border: 1px solid #e5e7eb;
    }

    .password-generator-container input[type="checkbox"] {
        accent-color: #3b82f6; /* Bleu au lieu de rouge */
    }

    .password-generator-container select {
        border: 1px solid #d1d5db;
        background-color: white;
    }

    .password-generator-container select:focus {
        outline: none;
        border-color: #3b82f6; /* Bleu au lieu de rouge */
        box-shadow: 0 0 0 1px #3b82f6;
    }

    #generatedPasswords input {
        font-family: 'Courier New', monospace;
    }
</style>

@section('content')

    <body class="h-full">
    <div class="min-h-screen flex flex-col items-center">
        <div class="max-w-4xl w-full">
            <div class="form-container-generer-lien">
                <div class="flex justify-between mb-8 items-start">
                    <div class="w-full pr-10">
                        <h2 class="text-lg font-semibold mb-2">Description</h2>

                        <p class="text-sm text-gray-600">Si vous devez envoyer un mot de passe ou toute autre forme d'informations simples mais sensibles à quelqu'un, vous ne pouvez pas l'envoyer par messagerie instantanée ou par courrier électronique. Ces méthodes ne sont pas sécurisées car toute personne ayant peu de connaissances peut intercepter ces informations lors de leur transmission. En utilisant OneTimeAtixit comme intermédiaire, vous pouvez transférer ces données en toute sécurité à votre destinataire. De cette manière, vous pouvez garantir la confidentialité et l'intégrité de vos informations sensibles.</p>                    </div>
                </div>
                <div class="flex justify-between mb-8 items-start">
                    <div class="w-full pr-10">
                        <h2 class="text-lg font-semibold mb-2">Étapes</h2>
                        <ol class="list-decimal text-sm text-gray-600 list-inside">
                            <li class="mb-2">Saisir votre texte</li>
                            <li class="mb-2">Générer votre lien</li>
                            <li>Partager avec qui vous voulez en toute sécurité</li>
                        </ol>
                    </div>
                </div>
                <form method="post" action="{{ route('generateLink') }}">
                    @csrf
                    <label for="message" class="label_t text-lg font-semibold mb-2"> Saisir votre message : </label>
                    <br>
                    <textarea id="message" name="message" class="message-input-generer-lien w-full rounded" placeholder="Entrez votre message ici..." required></textarea>
                    <button type="submit" class="submit-button-generer-lien bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Valider</button>
                </form>

                <form id="passwordForm" class="mt-7">
                    <div class="password-generator-container bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Générer un Mot de Passe personnalisé :</h3>

                        <!-- Options de génération -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" id="includeNumbers" checked class="mr-2">
                                    <span class="text-sm">Avec des chiffres <span class="text-blue-600 font-mono">[123...]</span></span>
                                </label>

                                <label class="flex items-center mb-2">
                                    <input type="checkbox" id="includeLowercase" checked class="mr-2">
                                    <span class="text-sm">Avec des lettres minuscules <span class="text-blue-600 font-mono">[abc...]</span></span>
                                </label>

                                <label class="flex items-center mb-2">
                                    <input type="checkbox" id="includeUppercase" checked class="mr-2">
                                    <span class="text-sm">Avec des lettres majuscules <span class="text-blue-600 font-mono">[ABC...]</span></span>
                                </label>

                                <label class="flex items-center mb-2">
                                    <input type="checkbox" id="includeSpecial" class="mr-2">
                                    <span class="text-sm">Avec des caractères spéciaux</span>
                                </label>

                                <label class="flex items-center mb-4">
                                    <input type="checkbox" id="excludeSimilar" checked class="mr-2">
                                    <span class="text-sm">Exclure les caractères similaires <span class="text-blue-600 font-mono">[o0iIl1]</span></span>
                                </label>
                            </div>

                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium mb-2">Nombre de caractères</label>
                                    <select id="passwordLength" class="w-full border rounded px-3 py-2">
                                        <option value="8">8</option>
                                        <option value="10">10</option>
                                        <option value="12">12</option>
                                        <option value="14" selected>14</option>
                                        <option value="16">16</option>
                                        <option value="20">20</option>
                                        <option value="24">24</option>
                                        <option value="32">32</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium mb-2">Nombre de mots de passe</label>
                                    <select id="passwordCount" class="w-full border rounded px-3 py-2">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de génération avec vos classes existantes -->
                        <button type="button" id="generatePasswordBtn" class="submit-button-generer-lien bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2 w-full mb-4">
                            Générer
                        </button>

                        <!-- Zone d'affichage des mots de passe générés -->
                        <div id="generatedPasswords" class="space-y-2"></div>
                    </div>
                </form>



            </div>
        </div>
    </div>

    <footer class="footer">
        Copyright © 2024 Atixit – SAS au capital de 7 000 € – 828 174 169 R.C.S. CRETEIL – Code APE 6202A – <a href="https://atixit.fr/" class="text-white">Voir notre site</a>
    </footer>

    <script>
        document.getElementById('generatePasswordBtn').addEventListener('click', function() {
            generateCustomPasswords();
        });

        function generateCustomPasswords() {
            const includeNumbers = document.getElementById('includeNumbers').checked;
            const includeLowercase = document.getElementById('includeLowercase').checked;
            const includeUppercase = document.getElementById('includeUppercase').checked;
            const includeSpecial = document.getElementById('includeSpecial').checked;
            const excludeSimilar = document.getElementById('excludeSimilar').checked;
            const passwordLength = parseInt(document.getElementById('passwordLength').value);
            const passwordCount = parseInt(document.getElementById('passwordCount').value);

            // Vérifier qu'au moins une option est sélectionnée
            if (!includeNumbers && !includeLowercase && !includeUppercase && !includeSpecial) {
                alert('Veuillez sélectionner au moins un type de caractère.');
                return;
            }

            // Définir les jeux de caractères
            let charset = '';

            if (includeNumbers) {
                charset += excludeSimilar ? '23456789' : '0123456789';
            }

            if (includeLowercase) {
                charset += excludeSimilar ? 'abcdefghijkmnpqrstuvwxyz' : 'abcdefghijklmnopqrstuvwxyz';
            }

            if (includeUppercase) {
                charset += excludeSimilar ? 'ABCDEFGHIJKMNPQRSTUVWXYZ' : 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }

            if (includeSpecial) {
                charset += '!@#$%^&*()_+-=[]{}|;:,.<>?';
            }

            // Générer les mots de passe
            const passwords = [];
            for (let i = 0; i < passwordCount; i++) {
                passwords.push(generatePassword(charset, passwordLength));
            }

            // Afficher les mots de passe
            displayPasswords(passwords);
        }

        function generatePassword(charset, length) {
            let password = '';
            for (let i = 0; i < length; i++) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }
            return password;
        }

        function displayPasswords(passwords) {
            const container = document.getElementById('generatedPasswords');
            container.innerHTML = '';

            passwords.forEach((password, index) => {
                const passwordDiv = document.createElement('div');
                passwordDiv.className = 'flex items-center space-x-2 p-3 bg-gray-100 rounded border';
                passwordDiv.innerHTML = `
            <input type="text" value="${password}" readonly class="flex-1 bg-transparent border-none outline-none font-mono text-sm" id="password-${index}">
            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm" onclick="copyPassword(${index})">
                Copier
            </button>
            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm" onclick="usePassword(${index})">
                Utiliser
            </button>
        `;
                container.appendChild(passwordDiv);
            });
        }

        function copyPassword(index) {
            const passwordInput = document.getElementById(`password-${index}`);
            passwordInput.select();
            document.execCommand('copy');

            // Feedback visuel
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Copié !';
            button.classList.remove('bg-blue-500', 'hover:bg-blue-700');
            button.classList.add('bg-green-500');

            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-500');
                button.classList.add('bg-blue-500', 'hover:bg-blue-700');
            }, 1500);
        }

        function usePassword(index) {
            const passwordInput = document.getElementById(`password-${index}`);
            const messageTextarea = document.getElementById('message');

            // Ajouter le mot de passe au textarea principal
            if (messageTextarea.value) {
                messageTextarea.value += '\n' + passwordInput.value;
            } else {
                messageTextarea.value = passwordInput.value;
            }

            // Feedback visuel
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Ajouté !';
            button.classList.remove('bg-green-500', 'hover:bg-green-700');
            button.classList.add('bg-blue-500');

            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-blue-500');
                button.classList.add('bg-green-500', 'hover:bg-green-700');
            }, 1500);
        }
    </script>
    </body>

@endsection


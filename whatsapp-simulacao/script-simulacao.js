// Máscaras e validações
        const form = document.getElementById('financingForm');
        const phoneInput = document.getElementById('phone');
        const phoneConfirmInput = document.getElementById('phoneConfirm');
        const phoneMismatchWarning = document.getElementById('phoneMismatchWarning');
        const valorEntradaField = document.getElementById('valorEntradaField');
        const entradaYes = document.getElementById('entradaYes');
        const entradaNo = document.getElementById('entradaNo');
        const valorEntradaInput = document.getElementById('valorEntrada');
        const rendaInput = document.getElementById('renda');

        // Máscara telefone
        function phoneMask(value) {
            return value
                .replace(/\D/g, '')
                .replace(/^(\d{2})(\d)/g, '($1) $2')
                .replace(/(\d{5})(\d)/, '$1-$2')
                .replace(/(-\d{4})\d+?$/, '$1');
        }

        phoneInput.addEventListener('input', (e) => {
            e.target.value = phoneMask(e.target.value);
            checkPhoneMatch();
        });

        phoneConfirmInput.addEventListener('input', (e) => {
            e.target.value = phoneMask(e.target.value);
            checkPhoneMatch();
        });

        // Máscara data de nascimento
        const birthdateInput = document.getElementById('birthdate');

        function dateMask(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{2})(\d)/, '$1/$2')
                .replace(/(\d{2})(\d)/, '$1/$2')
                .replace(/(\d{4})\d+?$/, '$1');
        }

        function validateAge(dateString) {
            const parts = dateString.split('/');
            if (parts.length !== 3) return false;

            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10);
            const year = parseInt(parts[2], 10);

            // Valida dia, mês e ano
            if (day < 1 || day > 31 || month < 1 || month > 12 || year < 1920 || year > 2010) {
                return false;
            }

            // Cria data
            const birthDate = new Date(year, month - 1, day);
            const today = new Date();

            // Calcula idade
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age >= 18;
        }

        birthdateInput.addEventListener('input', (e) => {
            e.target.value = dateMask(e.target.value);

            // Valida quando tiver formato completo
            if (e.target.value.length === 10) {
                if (validateAge(e.target.value)) {
                    e.target.classList.remove('error');
                } else {
                    e.target.classList.add('error');
                }
            }
        });

        birthdateInput.addEventListener('blur', (e) => {
            if (e.target.value.length === 10) {
                if (!validateAge(e.target.value)) {
                    e.target.classList.add('error');
                }
            } else if (e.target.value.length > 0) {
                e.target.classList.add('error');
            }
        });

        // Verificação em tempo real de telefones
        function checkPhoneMatch() {
            const phone = phoneInput.value;
            const phoneConfirm = phoneConfirmInput.value;

            // Só valida se ambos os campos tiverem conteúdo
            if (phone && phoneConfirm) {
                if (phone !== phoneConfirm) {
                    phoneConfirmInput.classList.add('error');
                    phoneMismatchWarning.classList.add('active');
                } else {
                    phoneConfirmInput.classList.remove('error');
                    phoneMismatchWarning.classList.remove('active');
                }
            } else {
                phoneMismatchWarning.classList.remove('active');
            }
        }

        // Validação ao sair do campo
        phoneConfirmInput.addEventListener('blur', checkPhoneMatch);

        // Máscara moeda
        function moneyMask(value) {
            value = value.replace(/\D/g, '');
            if (value === '') return '';
            value = (parseInt(value) / 100).toFixed(2);
            value = value.replace('.', ',');
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            return 'R$ ' + value;
        }

        valorEntradaInput.addEventListener('input', (e) => {
            e.target.value = moneyMask(e.target.value);
        });

        rendaInput.addEventListener('input', (e) => {
            e.target.value = moneyMask(e.target.value);
        });

        // Progressive disclosure - campo entrada
        entradaYes.addEventListener('change', () => {
            valorEntradaField.classList.add('active');
            valorEntradaInput.required = true;
        });

        entradaNo.addEventListener('change', () => {
            valorEntradaField.classList.remove('active');
            valorEntradaInput.required = false;
            valorEntradaInput.value = '';
        });

        // ==========================================
        // LISTA ÚNICA DE MOTOS (alimenta ambos selects)
        // ==========================================
        const motosDisponiveis = [
            '▪ Adv 150 abs - 2023 - Vermelha - R$ 23.870',
            '▪ Adv 150 abs - 2024 - Verde - R$ 24.870',
            '▪ Bis 125 es - 2014 - Preta - R$ 12.870',
            '▪ Biz 110i - 2023 - Prata - R$ 14.870',
            '▪ Biz 125 - 2021 - Prata - R$ 15.870',
            '▪ Biz 125 - 2016 - Azul - R$ 13.870',
            '▪ Biz 125 es - 2013 - Preta - R$ 12.870',
            '▪ Biz 125 es - 2013 - Vermelha - R$ 12.870',
            '▪ Bmw f800 r - 2012 - Cinza - R$ 26.870',
            '▪ Bmw g310 gs - 2023 - Preta - R$ 34.870',
            '▪ Bros 150 es - 2013 - Vermelha - R$ 13.570',
            '▪ Bros 160 esdd - 2022 - Vermelha - R$ 21.870',
            '▪ Bros 160 esdd - 2022 - Preta - R$ 20.870',
            '▪ Bros 160 esdd - 2019 - Branca - R$ 17.870',
            '▪ Cg 125 fan - 2013 - Preta - R$ 10.870',
            '▪ Cg 150 titan es - 2005 - Prata - R$ 10.870',
            '▪ Cg 150 titan ex - 2011 - Preta - R$ 12.570',
            '▪ Cg 150 titan ex - 2010 - Cinza - R$ 11.570',
            '▪ Cg 160 cargo - 2023 - Branca - R$ 18.500',
            '▪ Cg 160 fan - 2021 - Vermelha - R$ 18.570',
            '▪ Cg 160 fan - 2023 - Vermelha - R$ 18.870',
            '▪ Cg 160 start - 2022 - Vermelha - R$ 16.570',
            '▪ Cg 160 start - 2017 - Vermelha - R$ 14.870',
            '▪ Cg 160 titan - 2023 - Prata - R$ 20.570',
            '▪ Cg 160 titan - 2021 - Vermelha - R$ 19.870',
            '▪ Cg 160 titan - 2021 - Amarela - R$ 19.870',
            '▪ Cg 160 titan - 2023 - Vermelha - R$ 20.570',
            '▪ Crooser 150 s - 2021 - Branca - R$ 18.870',
            '▪ Crosser 150 - 2014 - Cinza - R$ 14.870',
            '▪ Crosser 150 ed - 2015 - Cinza - R$ 14.870',
            '▪ Crosser 150 ed - 2017 - Cinza - R$ 15.870',
            '▪ Crosser 150 s - 2022 - Azul - R$ 19.570',
            '▪ Dk 150 - 2020 - Preta - R$ 12.870',
            '▪ Factor 125 ed - 2011 - Vermelha - R$ 9.870',
            '▪ Factor 150 dx - 2025 - Cinza - R$ 19.870',
            '▪ Factor 150 ed - 2020 - Preta - R$ 15.870',
            '▪ Fazer 150 - 2022 - Azul - R$ 16.870',
            '▪ Fazer 150 ed - 2022 - Azul - R$ 16.870',
            '▪ Fazer 150 ed - 2014 - Preta - R$ 12.570',
            '▪ Fazer 150 sed - 2021 - Preta - R$ 16.870',
            '▪ Fazer 250 - 2021 - Vermelha - R$ 22.870',
            '▪ Fazer 250 - 2012 - Vermelha - R$ 15.870',
            '▪ Fazer 250 - 2010 - Preta - R$ 13.870',
            '▪ Fazer 250 abs - 2019 - Vermelha - R$ 20.870',
            '▪ Heritage classic 114 - 2022 - Preta - R$ 98.870',
            '▪ Lander 250 - 2024 - Bege - R$ 27.870',
            '▪ Mt 03 abs - 2021 - Azul - R$ 29.870',
            '▪ Mt 07 abs - 2024 - Azul - R$ 50.870',
            '▪ Mt 09 - 2015 - Laranja - R$ 44.870',
            '▪ Nc 750x abs - 2025 - Vermelha - R$ 57.870',
            '▪ Nmax 160 abs - 2022 - Verde - R$ 21.870',
            '▪ Pcx 160 abs - 2025 - Vermelha - R$ 21.870',
            '▪ Pop 110i - 2021 - Preta - R$ 10.870',
            '▪ Pop 110i - 2021 - Branca - R$ 10.870',
            '▪ Shadow 750 - 2006 - Vermelha - R$ 31.870',
            '▪ Twister 250f - 2016 - Vermelha - R$ 18.870',
            '▪ Twister 300f - 2025 - Azul - R$ 30.870',
            '▪ Twister 300f - 2025 - Vermelha - R$ 28.870',
            '▪ Xmax 250 abs - 2022 - Preta - R$ 27.870',
            '▪ Xmax 250 abs - 2023 - Azul - R$ 30.870',
            '▪ Xre 300 abs - 2021 - Cinza - R$ 28.870',
            '▪ Xt 660 r - 2008 - Preta - R$ 34.870',
            '▪ Z 1000 - 2012 - Preta - R$ 42.870',
            '▪ Z 400 abs - 2023 - Verde - R$ 30.870',
            '▪ Z800 - 2014 - Verde - R$ 39.870',
            '▪ Zx-10r - 2013 - Branca - R$ 47.870',
        ];


        // Função para popular os selects dinamicamente
        function popularSelects() {
            const moto1Select = document.getElementById('moto1');
            const moto2Select = document.getElementById('moto2');

            motosDisponiveis.forEach(moto => {
                // Criar value limpo (sem espaços e caracteres especiais)
                const value = moto.toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^a-z0-9-]/g, '');

                // Criar option para moto 1
                const option1 = document.createElement('option');
                option1.value = value;
                option1.textContent = moto;
                moto1Select.appendChild(option1);

                // Criar option para moto 2
                const option2 = document.createElement('option');
                option2.value = value;
                option2.textContent = moto;
                moto2Select.appendChild(option2);
            });
        }

        // Executar ao carregar a página
        popularSelects();

        // Submit form
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Validação final de telefones
            if (phoneInput.value !== phoneConfirmInput.value) {
                phoneConfirmInput.classList.add('error');
                phoneMismatchWarning.classList.add('active');
                phoneConfirmInput.focus();
                return;
            }

            // Validação geral do formulário
            if (!form.checkValidity()) {
                const inputs = form.querySelectorAll('input[required], select[required]');
                inputs.forEach(input => {
                    if (!input.validity.valid) {
                        input.classList.add('error');
                    }
                });
                return;
            }

            // Validação específica da data de nascimento
            const birthdateValue = document.getElementById('birthdate').value;
            if (birthdateValue.length !== 10 || !validateAge(birthdateValue)) {
                document.getElementById('birthdate').classList.add('error');
                document.getElementById('birthdate').focus();
                return;
            }

            // Coleta dados
            const moto1Select = document.getElementById('moto1');
            const moto2Select = document.getElementById('moto2');
            const moto1Text = moto1Select.value ? moto1Select.selectedOptions[0].text : 'Não selecionada';
            const moto2Text = moto2Select.value ? moto2Select.selectedOptions[0].text : 'Não selecionada';

            const formData = {
                nome: document.getElementById('name').value,
                telefone: phoneInput.value,
                dataNascimento: document.getElementById('birthdate').value,
                cnh: document.querySelector('input[name="cnh"]:checked').value,
                entrada: document.querySelector('input[name="entrada"]:checked').value,
                valorEntrada: valorEntradaInput.value || 'Não informado',
                renda: rendaInput.value,
                moto1: moto1Text,
                moto2: moto2Text
            };

            // Monta mensagem WhatsApp
            const mensagem = `Olá, eu gostaria de fazer uma simulação. Meus dados são:

*Nome:* ${formData.nome}
*Telefone:* ${formData.telefone}
*Data Nascimento:* ${formData.dataNascimento}
*CNH:* ${formData.cnh}
*Entrada:* ${formData.entrada}
${formData.entrada === 'sim' ? `*Valor Entrada:* ${formData.valorEntrada}` : ''}
*Renda:* ${formData.renda}
*Moto (1ª opção):* ${formData.moto1}
*Moto (2ª opção):* ${formData.moto2}

Aguardo retorno para prosseguir com a simulação!`;
            // Encode para URL
            const mensagemEncoded = encodeURIComponent(mensagem);

            // Mostra loading
            document.getElementById('loading').classList.add('active');

            // Simula salvamento no banco (substituir por API real)
            setTimeout(() => {
                // Aqui entraria a chamada à API:
                // await fetch('/api/financiamento', { method: 'POST', body: JSON.stringify(formData) });

                // Remove loading
                document.getElementById('loading').classList.remove('active');

                // Abre WhatsApp
                const numeroWhatsApp = '5516997305602'; // Substituir pelo número real
                window.open(`https://wa.me/${numeroWhatsApp}?text=${mensagemEncoded}`, '_blank');

                // Opcional: limpar formulário
                // form.reset();
            }, 1500);
        });

        // Remove erro ao digitar
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                input.classList.remove('error');
            });
        });
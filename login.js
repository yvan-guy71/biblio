document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const target = document.querySelector(btn.dataset.target);
                document.querySelectorAll('#login-box, #register-box').forEach(box => box.classList.add('hidden'));
                if (target) target.classList.remove('hidden');
            });
        });
        
<?php
require_once "./components/header.php";
?>

<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg">
        <h1 class="text-center text-2xl font-bold text-indigo-600 sm:text-3xl">Get started today</h1>
        <p class="mx-auto mt-4 max-w-md text-center text-gray-500">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati sunt dolores deleniti inventore quaerat mollitia?
        </p>
        <form id="signup-form" class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
            <p class="text-center text-lg font-medium">Create New Account</p>

            <div>
                <label for="username" class="sr-only">Username</label>
                <div class="relative">
                    <input
                        id="username"
                        type="text"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter username" />
                </div>
                <p id="username-error" class="text-xs  ms-1 text-red-500 mt-1"></p>
            </div>

            <div>
                <label for="email" class="sr-only">Email</label>
                <div class="relative">
                    <input
                        id="email"
                        type="email"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter email" />
                </div>
                <p id="email-error" class="text-xs ms-1 text-red-500 mt-1"></p>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>
                <div class="relative">
                    <input
                        id="password"
                        type="password"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter password" />
                </div>
                <p id="password-error" class="text-xs ms-1 text-red-500 mt-1"></p>
            </div>

            <button
                type="button"
                id="signup-button"
                class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                Sign up
            </button>
            <p class="text-center text-sm text-gray-500">
                Have an account?
                <a class="underline" href="./login.php">Login</a>
            </p>
        </form>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed top-5 right-5 space-y-3 z-50"></div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const showToast = (message, type = 'success') => {
        const toastContainer = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `p-4 rounded shadow text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
        toast.textContent = message;

        toastContainer.appendChild(toast);

        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.remove();
        }, 3000);
    };

    document.getElementById('signup-button').addEventListener('click', async function() {
        // Clear previous errors
        document.getElementById('username-error').textContent = '';
        document.getElementById('email-error').textContent = '';
        document.getElementById('password-error').textContent = '';

        // Get input values
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        // Validate inputs
        let hasErrors = false;

        if (username === '') {
            document.getElementById('username-error').textContent = "Username is required.";
            hasErrors = true;
        }

        if (email === '') {
            document.getElementById('email-error').textContent = "Email is required.";
            hasErrors = true;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            document.getElementById('email-error').textContent = "Invalid email format.";
            hasErrors = true;
        }

        if (password === '') {
            document.getElementById('password-error').textContent = "Password is required.";
            hasErrors = true;
        } else if (password.length < 6) {
            document.getElementById('password-error').textContent = "Password must be at least 6 characters long.";
            hasErrors = true;
        }

        // Stop submission if there are errors
        if (hasErrors) return;

        // Send data to signup.php using Axios
        try {
            const res = await axios.post('../actions/signup-action.php', {
                username: username,
                email: email,
                password: password
            });
            if (res.data.success) {
                showToast(res.data.success)
                window.location.href = "./login.php";
            } else {
                showToast(res.data.error, "error");
            }

        } catch (error) {
            if (error.response) {
                showToast(error.response.data.error || "An error occurred.", "error");
            }
        }
    });
</script>

<?php
require_once "./components/footer.php";
?>
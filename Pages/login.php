<?php
require_once "./components/header.php";
?>

<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg">
        <h1 class="text-center text-2xl font-bold text-indigo-600 sm:text-3xl">Get started today</h1>

        <p class="mx-auto mt-4 max-w-md text-center text-gray-500">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati sunt dolores deleniti
            inventore quaerat mollitia?
        </p>

        <!-- Login Form -->
        <form
            id="loginForm"
            class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8"
            onsubmit="return handleSubmit(event)">
            <p class="text-center text-lg font-medium">Log in to your account</p>

            <div>
                <label for="email" class="sr-only">Email</label>
                <div class="relative">
                    <input
                        type="text"
                        id="email"
                        name="email"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter email" />
                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="size-4 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </span>
                </div>
                <small id="emailError" class="text-red-600"></small>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter password" />
                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="size-4 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>
                <small id="passwordError" class="text-red-600"></small>
            </div>

            <button
                type="submit"
                class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                Log in
            </button>

            <p class="text-center text-sm text-gray-500">
                No account?
                <a class="underline" href="./signup.php">Sign up</a>
            </p>
        </form>
    </div>
</div>

<!-- Toast Notifications -->
<div id="toast-container" class="fixed top-5 right-5 space-y-3 z-50"></div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Show toast notifications
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

    // Form validation and submission
    async function handleSubmit(event) {
        event.preventDefault();
        console.log("I m here");
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        let isValid = true;

        // Clear previous errors
        document.getElementById("emailError").textContent = "";
        document.getElementById("passwordError").textContent = "";

        // Validate email
        if (!email) {
            document.getElementById("emailError").textContent = "Email is required.";
            isValid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            document.getElementById("emailError").textContent = "Enter a valid email address.";
            isValid = false;
        }

        // Validate password
        if (!password) {
            document.getElementById("passwordError").textContent = "Password is required.";
            isValid = false;
        } else if (password.length < 6) {
            document.getElementById("passwordError").textContent =
                "Password must be at least 6 characters long.";
            isValid = false;
        }
        if (!isValid) {
            return ;
        }
        try {
            const res = await axios.post("../actions/login-action.php",{
                email,
                password
            })
            if(res.data.success){
                showToast(res.data.success,"success")
                window.location.href = "./"
            }     
        } catch (error) {
            console.log(error)
                showToast(res.data.error,"error")  
        }
    }
</script>
<?php
require_once "./components/footer.php"
?>
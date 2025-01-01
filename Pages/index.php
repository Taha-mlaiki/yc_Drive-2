<?php
require_once "../classes/Database.php";

$db = new Database();
require_once "./components/header.php";
require_once "./components/navbar.php";
?>

<main>
    <div class="container flex items-center justify-center">
        <div>
            <h1 class="text-center text-3xl my-4 font-bold text-primary">Here some Text</h1>
            <p class="text-neutral-600 text-center mx-auto text-sm max-w-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim placeat, quisquam expedita voluptates ex quibusdam aliquid, facere ducimus ullam eos consequuntur aperiam voluptatibus </p>
            <img src="../assets/images/carLand.png" alt="" class="mx-auto">
        </div>
    </div>
    <div class="container">
        <span class="relative my-5 flex justify-center">
            <div
                class="absolute inset-x-0 top-1/2 h-px -translate-y-1/2 bg-transparent bg-gradient-to-r from-transparent via-gray-500 to-transparent opacity-75"></div>
            <span class="relative z-10 bg-white px-6 font-bold text-xl text-gray-700">Cars</span>
        </span>
        <div class="flex gap-x-3">
            <form>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    <option selected>Filter by category</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </form>
            <form>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    <option selected>Filter by modal</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </form>
        </div>
        <div class="grid my-16 md:grid-cols-2 gap-10 lg:grid-cols-3 ">
            <article class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm">
                <img
                    alt=""
                    src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                    class="h-56 w-full object-cover" />

                <div class="p-4 sm:p-6">
                    <a href="#">
                        <h3 class="text-lg font-medium text-gray-900">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </h3>
                    </a>

                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                        pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                        mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                        dignissimos. Molestias explicabo corporis voluptatem?
                    </p>

                    <a href="#" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-primary">
                        View details

                        <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                            &rarr;
                        </span>
                    </a>
                </div>
            </article>
        </div>
    </div>
</main>

<?php require_once "./components/footer.php"; ?>
<?php
require_once "./components/header.php";
require_once "./components/navbar.php";


?>
<main class="container">
    <div class="bg-white  border-2 rounded-lg relative m-10">

        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold">
                Create blog
            </h3>
        </div>

        <div class="p-6 space-y-6">
            <form action="#">
                <div class=" flex flex-col gap-6">
                    <div>
                        <label for="title" class="text-sm font-medium text-gray-900 block mb-2">Title</label>
                        <input type="text" name="title" id="title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Write blog title" required="">
                    </div>
                    <div>
                        <label for="image" class="text-sm font-medium text-gray-900 block mb-2">Image url</label>
                        <input type="text" name="image" id="image" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="https://exemple.com" required="">
                    </div>
                    <div>
                        <label for="video" class="text-sm font-medium text-gray-900 block mb-2">Video url</label>
                        <input type="text" name="video" id="video" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="https://exemple.com" required="">
                    </div>
                    <div class="col-span-full">
                        <label for="content" class="text-sm font-medium text-gray-900 block mb-2">Blog content</label>
                        <textarea id="content" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4" placeholder="write blog content here"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="p-6 border-t border-gray-200 rounded-b flex justify-end">
            <button class="text-white ms-auto bg-primary hover:bg-primary/80 focus:ring-4 focus:ring-primary/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save all</button>
        </div>

    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<?php require_once "./components/footer.php"; ?>
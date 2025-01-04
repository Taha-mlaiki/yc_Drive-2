<?php
if (file_exists("../classes/Car.php")) {
    include   "../classes/Car.php";
};
$id = $_GET["id"];
if (isset($id)) {
    $car = Car::getOneById($id);
}

require_once "./components/header.php";
require_once "./components/navbar.php";

    $userId = $_SESSION["id"];
    $carId = $car["vehicle_id"];
    $isReserved = Car::isUserReservedCard($carId,$userId);

    echo $isReserved;

?>
<main class="container">
    <div class="grid md:grid-cols-2 mt-16 xl:mt-24 gap-10">
        <div class="w-full flex flex-col items-center">
            <img src='<?= $car["vehicle_image"] ?>' alt="" class="rounded-md w-full my-auto">
        </div>
        <div class="h-full  flex flex-col justify-between py-3">
            <div class="mb-10">
                <h1 class="text-2xl lg:text-4xl mb-3 font-bold"><?= $car["vehicle_name"] ?></h1>
                <p class="text-neutral-700 text-sm mb-4 lg:max-w-[90%]"><?= $car["vehicle_description"] ?></p>
                <?php if ($car["available"]) : ?>
                    <span class="inline-block p-1 font-bold rounded-xl text-xs text-green-700 bg-green-300">
                        Available
                    </span>
                <?php else : ?>
                    <span class="inline-block p-1 font-bold rounded-xl text-xs text-red-700 bg-red-300">
                        Unavailable
                    </span>
                <?php endif; ?>
                <div class="mt-3">
                    <span class="font-bold text-blue-500">Modal :</span>
                    <?= $car["modal"] ?>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-2xl font-bold"><?= $car["vehicle_price"] ?>$</span>
                <button onclick="reserveCar(json_encode($car['vehicle_id']))" id="bookBtn-modal" class="px-2 py-1.5 rounded-lg text-white bg-primary hover:bg-primary/90">
                    Book now
                </button>
            </div>
        </div>
    </div>
    <div>
        <div class="flex items-center justify-between mt-8">
            <h2 class="text-xl font-bold">Reviews</h2>
            <?php if($isReserved):?>
            <button id="btn-modal" class="rounded-xl p-2 hover:bg-gray-100 transition text-primary font-semibold">Add my review</button>
            <?php endif ;?>
        </div>
        <div class="flex flex-col gap-y-5 mt-10">
            <?php foreach ($car["reviews"] as $review) : ?>
                <div>
                    <div class="flex items-center">
                        <button type="button" id="user-menu-button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 cursor-pointer" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="user photo">
                        </button>
                        <h4 class="text-neutral-700 font-semibold ms-3">
                            <?= $review["user"]["user_name"] ?>
                        </h4>
                    </div>
                    <div class="flex ms-8 mt-2 items-center">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php if ($i <= floor($review["stars"])): ?>
                                <!-- Fully filled star -->
                                <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            <?php elseif ($i === ceil($review["stars"]) && $review["stars"] - floor($review["stars"]) > 0): ?>
                                <!-- Half-filled star -->
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <defs>
                                        <linearGradient id="half-star" x1="0" x2="22" y1="0" y2="0" gradientUnits="userSpaceOnUse">
                                            <stop offset="50%" stop-color="#F59E0B" />
                                            <stop offset="50%" stop-color="#E5E7EB" />
                                        </linearGradient>
                                    </defs>
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" fill="url(#half-star)" />
                                </svg>
                            <?php else: ?>
                                <!-- Empty star -->
                                <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Book modal  -->
    <div id="book-modal" tabindex="-1" aria-hidden="true" class="hidden flex items-center justify-center fixed inset-0  w-full min-h-screen overflow-auto py-20 z-50 bg-black/30 backdrop-blur-lg">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Book <span class="text-primary">Car Name</span>
                    </h3>
                    <button type="button" id="closeBook-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="reservationForm" action="" method="post">
                    <div class="flex flex-col gap-y-2">
                        <label class="font-semibold text-neutral-700" for="reservation_date">Booking Date</label>
                        <input
                            class="border py-2 px-3 rounded-md border-primary focus:outline-none focus:ring focus:ring-primary/50"
                            type="date"
                            name="reservation_date"
                            id="reservation_date">
                        <p id="dateError" class="text-red-500 text-sm hidden"></p>
                    </div>
                    <div class="flex flex-col gap-y-2 my-3">
                        <label class="font-semibold text-neutral-700" for="reservation_time">Booking Place</label>
                        <input
                            placeholder="New York"
                            class="border py-2 px-3 rounded-md border-primary focus:outline-none focus:ring focus:ring-primary/50"
                            type="text"
                            name="reservation_time"
                            id="reservation_time">
                        <p id="timeError" class="text-red-500 text-sm hidden"></p>
                    </div>
                    <div class="mt-2">
                        <input
                            id="modal-btn"
                            type="submit"
                            name="create"
                            class="text-white flex items-center gap-x-1 font-semibold bg-primary hover:bg-primary/90 px-3 py-2 cursor-pointer rounded-lg ms-auto" />
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Review modal -->
    <div id="review-modal" tabindex="-1" aria-hidden="true" class="hidden flex items-center justify-center fixed inset-0  w-full min-h-screen overflow-auto py-20 z-50 bg-black/30 backdrop-blur-lg">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add my review
                    </h3>
                    <button type="button" id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="reveiw_form" class="p-4 md:p-5" id="menuForm" action="" method="post">
                    <input id="pi_input" type="range" min="0" max="5" step="0.5" />
                    <p>Value: <output id="value"></output></p>
                    <input type="hidden" id="user_id" value="<?= $userId ?>">
                    <input type="hidden" id="car_id" value="<?= $carId ?>">
                    <input
                        id="modal-btn"
                        type="submit"
                        name="create"
                        class="text-white flex items-center gap-x-1 font-semibold bg-primary hover:bg-primary/90 px-3 py-2 rounded-lg ms-auto" />
                </form>
            </div>
        </div>
    </div>

</main>
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
    const rating_value = document.querySelector("#value");
    const ratingInput = document.querySelector("#pi_input");
    // review modal
    const reviewModal = document.getElementById("review-modal");
    const btnReviewModal = document.getElementById("btn-modal");
    const closeReviewModal = document.getElementById("close-modal")
    // booking modal
    const bookModal = document.getElementById("book-modal");
    const btnBookModal = document.getElementById("bookBtn-modal");
    const closeBookModal = document.getElementById("closeBook-modal")


    rating_value.textContent = ratingInput.value;
    ratingInput.addEventListener("input", (event) => {
        rating_value.textContent = event.target.value;
    });

    if(btnReviewModal){
        btnReviewModal.addEventListener("click", () => {
            reviewModal.classList.remove("hidden");
        })
    }
    closeReviewModal.addEventListener("click", () => {
        reviewModal.classList.add("hidden");
    })
    btnBookModal.addEventListener("click", () => {
        bookModal.classList.remove("hidden");
    })
    closeBookModal.addEventListener("click", () => {
        bookModal.classList.add("hidden");
    })

    const form = document.getElementById("reservationForm");
    const dateInput = document.getElementById("reservation_date");
    const placeInput = document.getElementById("reservation_time");
    const dateError = document.getElementById("dateError");
    const placeError = document.getElementById("timeError");
    const reviewForm = document.getElementById("reveiw_form")

    const userId = document.getElementById("user_id").value
    const carId = document.getElementById("car_id").value


    form.addEventListener("submit", (e) => {
        let valid = true;

        // Validate Booking Date
        if (!dateInput.value) {
            dateError.textContent = "Please select a valid booking date.";
            dateError.classList.remove("hidden");
            valid = false;
        } else {
            dateError.classList.add("hidden");
        }

        // Validate Booking Place
        if (!placeInput.value.trim()) {
            placeError.textContent = "Please enter a valid booking place.";
            placeError.classList.remove("hidden");
            valid = false;
        } else {
            placeError.classList.add("hidden");
        }

        if (!valid) {
            e.preventDefault(); // Prevent form submission if invalid
        }
    });

    reviewForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const data = {
            userId,
            carId,
            star : ratingInput.value
        }
        console.log(data);

        const res = await axios.post("../actions/cars/add_review.php",data);
        console.log(res);

    })
</script>
<?php
require_once "./components/navbar.php";
?>
<?php
include "./components/header.php";
require_once "../classes/Reservation.php";
require_once "../classes/User.php";
$reservations = Reservation::getAllReservations();
$pending = Reservation::reservationStatistiques("Pending");
$canceled = Reservation::reservationStatistiques("Canceled");
$accepted = Reservation::reservationStatistiques("Accepted");
$totalUsers = User::userStatistiques("SELECT COUNT(*) FROM users");

?>
<div class="min-h-screen flex flex-col">
    <?php include "./components/navbar.php" ?>
    <div class="relative flex flex-1">
    <?php include "./components/sideBar.php" ?>
        <div class="relative flex-1 p-6 overflow-auto">
            <main class="px-5 flex-grow h-full lg:px-10 mt-5">
                <h1 class="font-bold text-neutral-700 text-3xl underline">Dashboard</h1>
                <h2 class="font-semibold flex items-center gap-x-2 text-neutral-700 text-lg mt-10">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    Statistiques
                </h2>
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5 mt-10">
                    <div class=" rounded-md border p-5 py-7 ">
                        <div class="flex items-center gap-x-2">
                            <svg viewBox="0 -0.5 25 25" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.875 7.375C14.875 8.68668 13.8117 9.75 12.5 9.75C11.1883 9.75 10.125 8.68668 10.125 7.375C10.125 6.06332 11.1883 5 12.5 5C13.8117 5 14.875 6.06332 14.875 7.375Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.25 15.775C17.25 17.575 15.123 19.042 12.5 19.042C9.877 19.042 7.75 17.579 7.75 15.775C7.75 13.971 9.877 12.509 12.5 12.509C15.123 12.509 17.25 13.971 17.25 15.775Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9 9.55301C19.9101 10.1315 19.5695 10.6588 19.0379 10.8872C18.5063 11.1157 17.8893 11 17.4765 10.5945C17.0638 10.189 16.9372 9.57418 17.1562 9.03861C17.3753 8.50305 17.8964 8.1531 18.475 8.15301C19.255 8.14635 19.8928 8.77301 19.9 9.55301V9.55301Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.10001 9.55301C5.08986 10.1315 5.43054 10.6588 5.96214 10.8872C6.49375 11.1157 7.11072 11 7.52347 10.5945C7.93621 10.189 8.06278 9.57418 7.84376 9.03861C7.62475 8.50305 7.10363 8.1531 6.52501 8.15301C5.74501 8.14635 5.10716 8.77301 5.10001 9.55301Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19.2169 17.362C18.8043 17.325 18.4399 17.6295 18.403 18.0421C18.366 18.4547 18.6705 18.8191 19.0831 18.856L19.2169 17.362ZM22 15.775L22.7455 15.8567C22.7515 15.8023 22.7515 15.7474 22.7455 15.693L22 15.775ZM19.0831 12.695C18.6705 12.7319 18.366 13.0963 18.403 13.5089C18.4399 13.9215 18.8044 14.226 19.2169 14.189L19.0831 12.695ZM5.91689 18.856C6.32945 18.8191 6.63395 18.4547 6.59701 18.0421C6.56007 17.6295 6.19567 17.325 5.78311 17.362L5.91689 18.856ZM3 15.775L2.25449 15.693C2.24851 15.7474 2.2485 15.8023 2.25446 15.8567L3 15.775ZM5.78308 14.189C6.19564 14.226 6.56005 13.9215 6.59701 13.5089C6.63397 13.0963 6.32948 12.7319 5.91692 12.695L5.78308 14.189ZM19.0831 18.856C20.9169 19.0202 22.545 17.6869 22.7455 15.8567L21.2545 15.6933C21.1429 16.7115 20.2371 17.4533 19.2169 17.362L19.0831 18.856ZM22.7455 15.693C22.5444 13.8633 20.9165 12.5307 19.0831 12.695L19.2169 14.189C20.2369 14.0976 21.1426 14.839 21.2545 15.8569L22.7455 15.693ZM5.78311 17.362C4.76287 17.4533 3.85709 16.7115 3.74554 15.6933L2.25446 15.8567C2.45496 17.6869 4.08306 19.0202 5.91689 18.856L5.78311 17.362ZM3.74551 15.8569C3.85742 14.839 4.76309 14.0976 5.78308 14.189L5.91692 12.695C4.08354 12.5307 2.45564 13.8633 2.25449 15.693L3.74551 15.8569Z" fill="#000000"></path>
                                </g>
                            </svg>
                            <span class="font-bold text-neutral-700 text-2xl"><?= $totalUsers ?></span>
                        </div>
                        <p class="text-neutral-700 mt-4 font-medium">
                            Total number Signup Users
                        </p>
                    </div>
                    <div class=" rounded-md border p-5 py-7 ">
                        <div class="flex items-center gap-x-2">
                            <img src="../assets/images/calendarAccept.svg" class="w-10 h-10" />
                            <span class="font-bold text-neutral-700 text-2xl"><?= $accepted ?></span>
                        </div>
                        <p class="text-neutral-700 mt-4 font-medium">
                            Total number of Accepted reservations
                        </p>
                    </div>
                    <div class=" rounded-md border p-5 py-7 ">
                        <div class="flex items-center gap-x-2">
                            <img src="../assets/images/clipboard.png" class="w-8 h-8" />
                            <span class="font-bold text-neutral-700 text-2xl"><?= $pending ?></span>
                        </div>
                        <p class="text-neutral-700 mt-4 font-medium">
                            Total number of Pending reservations
                        </p>
                    </div>
                    <div class=" rounded-md border p-5 py-7 ">
                        <div class="flex items-center gap-x-2">
                            <img src="../assets/images/calendar.png" class="w-8 h-8" />
                            <span class="font-bold text-neutral-700 text-2xl"><?= $canceled ?></span>
                        </div>
                        <p class="text-neutral-700 mt-4 font-medium">
                            Total number of Rejected reservations
                        </p>
                    </div>
                </div>
                <h2 class="font-semibold text-neutral-700  flex items-center gap-x-2 text-lg mt-10">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                    </svg>
                    Reservations
                </h2>
                <div class="relative overflow-x-auto  mt-10 shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    Image
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    name
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    modal
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    Category
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    Price $$
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    User name
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    User email
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    date
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    place
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    status
                                </th>
                                <th scope="col" class=" py-3 min-w-[100px]">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($reservations) || count($reservations) > 0) :  ?>
                                <?php foreach ($reservations as $reserv): ?>
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <img src=<?= $reserv["car_image"] ?> class="w-32 rounded-lg">
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= $reserv["car_name"] ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?= $reserv["car_modal"] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $reserv["category"] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $reserv["car_price"] ?>$
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $reserv["user_name"] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $reserv["user_email"] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $reserv["reservation_date"] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $reserv["reservation_place"] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php switch ($reserv["reservation_status"]) {
                                                case 'Pending':
                                                    echo "<span class='text-yellow-500 p-1 rounded-xl bg-yellow-100 text-sm'>Pending</span>";
                                                    break;
                                                case 'Accepted':
                                                    echo "<span class='text-green-500 p-1 rounded-xl bg-green-100 text-sm'>Accepted</span>";
                                                    break;
                                                case 'Canceled':
                                                    echo "<span class='text-red-500 p-1 rounded-xl bg-red-100 text-sm'>Canceled</span>";
                                                    break;
                                                default:
                                                    echo "<span class='text-yellow-500 p-1 rounded-xl bg-yellow-100 text-sm'>Pending</span>";
                                                    break;
                                            }  ?>
                                        </td>
                                        <?php if ($reserv["reservation_status"] !== "Canceled" &&  $reserv["reservation_status"] !== "Accepted") : ?>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-x-3">
                                                    <button onclick="acceptReserv(<?= json_encode($reserv['reservation_id']) ?>)" class="bg-green-700 p-2 text-white rounded-md">
                                                        Accept
                                                    </button>
                                                    <button onclick="cancelReserv(<?= json_encode($reserv['reservation_id']) ?>)" class="bg-red-700 p-2 text-white rounded-md">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <th colspan="100%" class="text-center text-neutral-700 w-full py-4">
                                        No reservation available.
                                    </th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </main>


        </div>
    </div>
</div>
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

    const acceptReserv = async (reservId) => {
        if (!reservId) {
            return;
        }
        const res = await axios.post("../actions/reservation/accept.php", {
            reservId
        })
        if (res.data.success) {
            showToast(res.data.success);
            window.location.reload();
        } else {
            showToast(res.data.error, "error")
        }
    }
    const cancelReserv = async (reservId) => {
        if (!reservId) {
            return;
        }
        const res = await axios.post("../actions/reservation/cancel.php", {
            reservId
        })
        if (res.data.success) {
            showToast(res.data.success);
            window.location.reload();
        } else {
            showToast(res.data.error, "error")
        }
    }
</script>

<?php include "./components/footer.php" ?>
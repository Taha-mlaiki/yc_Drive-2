<?php
include "./components/header.php";
include "./components/navbar.php";
require_once "../classes/Reservation.php";

$userid = $_SESSION["id"];
$reservations = Reservation::getAllUserReserv($userid);
?>
<main class="max-w-screen-xl my-20 mx-auto px-5">
    <div class="flex items-center gap-x-3 mt-10">
        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 8V12L14.5 14.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M5.60423 5.60423L5.0739 5.0739V5.0739L5.60423 5.60423ZM4.33785 6.87061L3.58786 6.87438C3.58992 7.28564 3.92281 7.61853 4.33408 7.6206L4.33785 6.87061ZM6.87963 7.63339C7.29384 7.63547 7.63131 7.30138 7.63339 6.88717C7.63547 6.47296 7.30138 6.13549 6.88717 6.13341L6.87963 7.63339ZM5.07505 4.32129C5.07296 3.90708 4.7355 3.57298 4.32129 3.57506C3.90708 3.57715 3.57298 3.91462 3.57507 4.32882L5.07505 4.32129ZM3.75 12C3.75 11.5858 3.41421 11.25 3 11.25C2.58579 11.25 2.25 11.5858 2.25 12H3.75ZM16.8755 20.4452C17.2341 20.2378 17.3566 19.779 17.1492 19.4204C16.9418 19.0619 16.483 18.9393 16.1245 19.1468L16.8755 20.4452ZM19.1468 16.1245C18.9393 16.483 19.0619 16.9418 19.4204 17.1492C19.779 17.3566 20.2378 17.2341 20.4452 16.8755L19.1468 16.1245ZM5.14033 5.07126C4.84598 5.36269 4.84361 5.83756 5.13505 6.13191C5.42648 6.42626 5.90134 6.42862 6.19569 6.13719L5.14033 5.07126ZM18.8623 5.13786C15.0421 1.31766 8.86882 1.27898 5.0739 5.0739L6.13456 6.13456C9.33366 2.93545 14.5572 2.95404 17.8017 6.19852L18.8623 5.13786ZM5.0739 5.0739L3.80752 6.34028L4.86818 7.40094L6.13456 6.13456L5.0739 5.0739ZM4.33408 7.6206L6.87963 7.63339L6.88717 6.13341L4.34162 6.12062L4.33408 7.6206ZM5.08784 6.86684L5.07505 4.32129L3.57507 4.32882L3.58786 6.87438L5.08784 6.86684ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12H21.75C21.75 6.61522 17.3848 2.25 12 2.25V3.75ZM12 20.25C7.44365 20.25 3.75 16.5563 3.75 12H2.25C2.25 17.3848 6.61522 21.75 12 21.75V20.25ZM16.1245 19.1468C14.9118 19.8483 13.5039 20.25 12 20.25V21.75C13.7747 21.75 15.4407 21.2752 16.8755 20.4452L16.1245 19.1468ZM20.25 12C20.25 13.5039 19.8483 14.9118 19.1468 16.1245L20.4452 16.8755C21.2752 15.4407 21.75 13.7747 21.75 12H20.25ZM6.19569 6.13719C7.68707 4.66059 9.73646 3.75 12 3.75V2.25C9.32542 2.25 6.90113 3.32791 5.14033 5.07126L6.19569 6.13719Z" fill="#1C274C" />
        </svg>
        <h1 class="font-bold text-neutral-700 text-3xl underline">
            Reservations
        </h1>
    </div>
    <div class="relative overflow-x-auto  mt-10 shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        modal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price $$
                    </th>
                    <th scope="col" class="px-6 py-3">
                        date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        place
                    </th>
                    <th scope="col" class="px-6 py-3">
                        status
                    </th>
                    <th scope="col" class="px-6 py-3">
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
                            <?php if ($reserv["reservation_status"] !== "Canceled") : ?>
                                <td class="px-6 py-4">
                                    <button onclick="cancelReservation(<?php echo json_encode($reserv['reservation_id']); ?>)">Cancel</button>
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
    const cancelReservation = async (reservId) => {
        if (!reservId) {
            return;
        }
        const res = await axios.post("../actions/reservation/cancel.php", {
            reservId
        })
        if (res.data.success) {
            showToast(res.data.success);
        } else {
            showToast(res.data.error, "error")
        }
    }
</script>
<?php include "./components/footer.php"  ?>
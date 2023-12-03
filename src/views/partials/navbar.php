<?php $url = parse_url($_SERVER['REQUEST_URI'])['path']; ?>


<nav class="px-1 px-lg-3 navbar navbar-expand-lg justify-content-between bg-white border border-2 border-dark text-dark gap-3 mynavbar">
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarToggler">
        <ul class=" navbar-nav gap-3 nav-underline">
            <li class='nav-item d-flex justify-content-center'>
                <a class="nav-link <?= $url === '/home' || $url === '/'  ? 'active' : '' ?>" href="/home" style="width: 70px; text-align: center;">Home</a>
            </li>
            <li class='nav-item d-flex justify-content-center'>
                <a class="nav-link <?= $url === '/schedule' || $url === '/change' ? 'active' : '' ?>" href="/schedule" style="width: 90px; text-align: center;">Schedule</a>
            </li>
            <li class='nav-item d-flex justify-content-center'>
                <a class="<?= $url === '/history' ? 'active' : '' ?> nav-link" href="/history" style="width: 70px; text-align: center;">History</a>
            </li>
            <li class='nav-item d-flex justify-content-center'>
                <form action="controllers/logout.php">
                    <button type="submit" class='btn btn-dark text-white rounded-0' style="width: 85px; height: 100%;">Log out</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
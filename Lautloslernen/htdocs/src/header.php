<div class="header" style="background-color: #4d73a6; color: #FFFFFF; display: flex;">
    <div class="logo" style="border-radius: 10px; margin-right: 5%; margin-left: 10px; margin-top: 10px;">
        <a href="http://localhost:8080" style="text-decoration: none;">
            <img src="/img/LogoLtransparent.png" style="width: 140px; height: 100%;" alt="Lautlos Lernen">
        </a>
    </div>

    <div class="nav" style="display: flex; align-items: center;">
        <a href="/" class="nav-link">Home</a>
       <?php if(isset($_SESSION['isLoggin']) && $_SESSION['isLoggin'] == true): ?>
            <a href="/?c=learning" class="nav-link">Lernen</a>
            <a href="/?c=dashboard" class="nav-link">Dashboard</a>
            <a href="/?c=letter" class="nav-link">Buchstaben</a>
            <a href="https://secure.spendenbank.de/form/3084" class="nav-link">Spenden</a>
            <a href="/?a=logoff&c=user" class="nav-link">Abmelden</a>

       <?php else: ?>
            <a href="/?a=login&c=user" class="nav-link">Anmelden</a>
       <?php endif; ?>
    </div>
</div>

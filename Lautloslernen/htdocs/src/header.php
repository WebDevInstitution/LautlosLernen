<div class="header" style="background-color: black; color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px;">

    <div class="logo" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <a href="http://localhost:8080"><img src="/img/lautloslernen.png" style="width: 20%; height: auto; border-radius: 10px;" alt="Lautlos Lernen"></a>
    </div>

    <div class="nav" style="display: flex; margin-right: 40px;">
        <a href="/" class="nav-link" style="background-color: grey; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; font-size: 16px; margin: 4px 2px; cursor: pointer;">Home</a>
       <?php if(isset($_SESSION['isLoggin']) && $_SESSION['isLoggin'] == true): ?>
            <a href="/?c=learning" class="nav-link" style="background-color: grey; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; font-size: 16px; margin: 4px 2px; cursor: pointer;">Lernen</a>
            <a href="/?c=dashbord" class="nav-link" style="background-color: grey; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; font-size: 16px; margin: 4px 2px; cursor: pointer;">Dashboard</a>
            <a href="/?c=letter" class="nav-link" style="background-color: grey; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; font-size: 16px; margin: 4px 2px; cursor: pointer;">Buchstaben</a>
            <a href="/?a=logoff&c=user" class="nav-link" style="background-color: grey; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; font-size: 16px; margin: 4px 2px; cursor: pointer;">logoff</a>

            <?php else: ?>

            <?php endif; ?>
    </div>

    <div class="avatar">
        <a href="/?c=user">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.3163 19.4384C5.92462 18.0052 7.34492 17 9 17H15C16.6551 17 18.0754 18.0052 18.6837 19.4384M16 9.5C16 11.7091 14.2091 13.5 12 13.5C9.79086 13.5 8 11.7091 8 9.5C8 7.29086 9.79086 5.5 12 5.5C14.2091 5.5 16 7.29086 16 9.5ZM22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
</div>

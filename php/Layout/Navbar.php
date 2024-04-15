<!-- Nav Bar Start That will be Shared in All Pages thats why it is in this page as this page is inluded in all pages to connect to Databse-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><span style="color:salmon;">J</span>ournaling</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="TodayList.php">Today's List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="AddData.php">Add Data</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="History.php">History</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="AddQuestions.php">Add Questions</a>
            </li>
            <?php if ((new \App\Authentication())->is_auth()): ?>
                <li class="nav-item ">
                    <a style="color: red" class="nav-link" href="?logout=1">LogOut</a>
                </li>
            <?php else: ?>
                <li class="nav-item ">
                    <a style="color: green" class="nav-link" href="SignIn.php">Sign In</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<!-- Nav Bar End-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {
        margin: 0;
        background-color: #f1f1f1;
        font-family: Arial, Helvetica, sans-serif;
    }

    #navbar {
        background-color: #333;
        position: fixed;
        top: 0;
        width: 100%;
        display: block;
        transition: top 0.3s;
    }

    #navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 15px;
        text-decoration: none;
        font-size: 17px;
    }

    #navbar a:hover {
        background-color: #ddd;
        color: black;
    }

</style>

<header>

    <div id="navbar">
        <a href="index.php">Главная</a>
        <a href=>Категории</a>
    </div>


<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-50px";
        }
        prevScrollpos = currentScrollPos;
    }
</script>
</header>
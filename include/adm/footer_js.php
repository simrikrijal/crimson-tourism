       <!-- Menu Toggle Script -->
    <script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>
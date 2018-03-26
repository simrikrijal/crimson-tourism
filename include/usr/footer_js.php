    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('#myTable').DataTable();
        });
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>



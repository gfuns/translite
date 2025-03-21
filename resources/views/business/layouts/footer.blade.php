    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('bower_components/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('bower_components/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ asset('bower_components/editable-table/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/tether/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('bower_components/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/util.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/alert.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/button.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/carousel.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/collapse.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/dropdown.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/modal.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/tab.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/tooltip.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/js/dist/popover.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/main5739.js') }}?version=4.5.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>

    @include('sweetalert::alert')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#pm').select2({
                width: '100%' // Ensure it takes full width
            });
        });

        $(document).ready(function() {
            $('#status').select2({
                width: '100%' // Ensure it takes full width
            });
        });


        $(document).ready(function() {
            $('#dateRange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD' // Change the format as needed
                },
                autoUpdateInput: false,
                opens: 'right'
            });

            // Update input value when selecting dates
            $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            // Clear input when canceling
            $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });


        document.getElementById("clearFilters").addEventListener("click", function() {
            document.getElementById("dateRange").value = "";
            document.getElementById("transId").value = "";
            document.getElementById("status").value = "";
        });


        function closeOffcanvas() {
            let offcanvas = document.getElementById("filterOffcanvas");
            offcanvas.classList.remove("show");

            // Wait for animation to complete before removing backdrop
            setTimeout(() => {
                document.body.classList.remove("offcanvas-backdrop");
            }, 300); // Adjust timing to match CSS transition
        }
    </script>

    {{-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script> --}}

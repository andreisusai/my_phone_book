<!-- component -->
<!-- This is an example component -->
<div class="flex justify-center mt-6">
    <div class="pt-2 relative mx-auto text-gray-600">
        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="contributor_search" id="contributor_search" placeholder="Search">
        <button class="absolute right-0 top-0 mt-5 mr-4">
            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
            </svg>
        </button>
    </div>
</div>

<div class="flex justify-center mt-6 mb-6">
    <div class="w-10/12 bg-white p-6 rounded-lg">
        <h3 class="text-center p-6">Résultat de votre recherche <span id="total_records"></span></h3>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="w-1/4 ...">Nom</th>
                    <th class="w-1/4 ...">Prénom</th>
                    <th class="w-1/4 ...">Téléphone</th>
                    <th class="w-1/4 ...">Email</th>
                    <th class="w-1/4 ... p-3">Entreprise</th>
                    <th class="w-1/4 ... p-3">Numéro entreprise</th>
                    @if(auth()->user()->role !== "user")
                    <th class="w-1/4 ... p-3">Éditer</th>
                    @endif
                    @if(auth()->user()->role === "admin")
                    <th class="w-1/4 ... p-3">Supprimer</th>
                    @endif
                </tr>
            </thead>
            <tbody id="contributor_table"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        fetch_company_data();

        function fetch_company_data(val = '') {

            $.ajax({
                url: "{{ route('collaborateurs.action') }}",
                method: 'GET',
                data: {
                    query: val
                },
                dataType: 'json',
                error: function(xrh, status, error) {},
                success: function(data) {
                    $('#contributor_table').html(data.table_data);
                    $('#total_records').text(data.total_data);
                }
            });
            if (val == '') {
                $('#contributor_table').empty();
                $('#total_records').empty();
                $('#contributor_search').val('');
            }
        };

        $(document).on('keyup', '#contributor_search', function() {
            let query = $(this).val();
            fetch_company_data(query);
        });
    });
</script>
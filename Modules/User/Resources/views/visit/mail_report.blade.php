<h3>Dear Sir, Below are overall requests received for Mahankal Lok Darshan </h3>

<table border="1">
    <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th class="nk-tb-col tb-col-mb"><span class="sub-text">#</span></th>
            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Contact Number</span></th>
            <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Country</span></th>
            <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Members</span></th>
            <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Departure From Indore</span></th>
            <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Departure From Ujjain</span></th>
            <th class="nk-tb-col tb-col-md w-1" nowrap="true"><span class="sub-text">Requested At</span></th>
        </tr>
    </thead>
    <tbody>
        @forelse($visiters as $key => $visiter)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $visiter->name }}</td>
            <td>{{ $visiter->email }}</td>
            <td>{{ $visiter->mobile }}</td>
            <td>{{ $visiter->country }}</td>
            <td>{{ $visiter->members }}</td>
            <td>{{ $visiter->departure_indore }}</td>
            <td>{{ $visiter->departure_ujjain }}</td>
            <td>{{ $visiter->created_at }}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>
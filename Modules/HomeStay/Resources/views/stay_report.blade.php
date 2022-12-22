<h3>Dear Sir, Below are overall requests received for Free Home Stay </h3>

<table border="1">
    <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th class="nk-tb-col tb-col-mb"><span class="sub-text">#</span></th>
            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></th>
            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Mobile</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Guest 1 Name/Age</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Guest 2 Name/Age</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Check In Date</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Check Out Date</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Host Alloted</span></th>
            <th class="nk-tb-col tb-col-md"><span class="sub-text">Host Name</span></th>
            <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Status</span>
            </th>
            <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Requested On</span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tbody>
        @forelse($stays as $key => $stay)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $stay->name }}</td>
            <td>{{ $stay->email }}</td>
            <td>{{ $stay->mobile }}</td>
            <td>{{ $stay->country }}</td>
            <td>{{ $stay->guest_name_1.'/'.$stay->guest_age_1 }}</td>
            @if(!is_null($stay->guest_name_2))
                <td>{{ $stay->guest_name_2.'/'.$stay->guest_age_2 }}</td>
            @else
                <td>NA</td>
            @endif
            <td>{{ $stay->check_in_date }}</td>
            <td>{{ $stay->check_out_date }}</td>
            <td>{{ ($stay->host_id > 0) ? 'Yes' : 'No' }}</td>
            <td>{{ $stay->hostName }}</td>
            <td>{{ $stay->status }}</td>
            <td>{{ date('d-M-Y',strtotime($stay->created_at)) }}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
    </tbody>
</table>
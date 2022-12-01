@component('mail::message')
    # Introduction

    The body of your message.

    @component('mail::button', ['url' => ''])
        <table>
            <thead>
            <tr>
                <th>Medicine</th>
                <th>Comment</th>
                <th>Morning</th>
                <th>After Noon</th>
                <th>Evening</th>
            </tr>
            </thead>
            <tbody>
            @foreach($body['eprescriptiondetail'] as $eprescriptiondetail)
                <tr>
                    <td>{{ $eprescriptiondetail->medicine }}</td>
                    <td>{{ ($eprescriptiondetail->comment) ? $eprescriptiondetail->comment : '' }}</td>
                    <td>{{ ($eprescriptiondetail->morning) ? 'Yes' : ''}}</td>
                    <td>{{ ($eprescriptiondetail->after_noon) ? 'Yes' : ''}}</td>
                    <td>{{ ($eprescriptiondetail->evening) ? 'Yes' : ''}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

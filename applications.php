<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/applications.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <title>Applications</title>
</head>

<body>
    <form class="search_form" id="search_form" method="get">
        <div class="search">
            <button class="button_search" id="button_search" type="button"><i class="fa fa-search"
                    name="search"></i></button>
            <input id="search_text" class="inputSearch" type="text" placeholder="Search..." name="search">
        </div>
    </form>
    <table class="applicationsTable">
        <tr>
            <th>Event</th>
            <th>Status</th>
            <th>Remarks</th>
        </tr>

        <tr>
            <td>Music Event Extravaganza</td>
            <td class="accepted"><input type="text" class="greenAccepted" value="Accepted"></td>
            <td>Congrats! your application is accepted. The recruiter will
                communicate you through your email address!</td>
        </tr>
        <tr>
            <td>Open Mic</td>
            <td class="pending"> <input type="text" value="Pending" class="greyPending"></td>
            <td>Not yet available</td>
        </tr>
        <tr>
            <td>Garden View Art</td>
            <td class="rejected"> <input type="text" value="Rejected" class="redRejected"></td>
            <td>Unfortunately your application isn't accepted! But don't worry the platform has
                other gig applications, so don't limit yourself</td>
        </tr>

    </table>
</body>

</html>
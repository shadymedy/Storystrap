<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Imo Portal</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">


    <style>
        body {
            background: rgb(204, 204, 204);
            font-size: 11px;
            font-family: 'helvetica', sans-serif;
        }

        page[size="A4"] {
            width: 21cm;
            height: 30.7cm;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            /* margin-bottom: 0.5cm; */
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        @media print {
            body,
            page {
                box-shadow: 0;
                font-size: 14px!important;
            }
            page[size="A4"] {
                width: 23cm;
                height: 30.7cm;
            }
            .cert-header {
                width: 100%;
                display: block;
                clear: both;
                height: 10cm;
                margin-top: 0cm;
                margin-bottom: 1cm;
            }
            .header-left {
                width: 20%;
                float: left;
                margin-top: -40px!important;
            }
            .header-left img {
                display: none;
            }
            .header-middle {
                margin-top: 0.8cm;
                margin-left: 19.2%;
            }
            p {
                text-align: justify;
                line-height: 0.5cm;
            }
            li {
                margin-left: 20px;
                margin-right: 10px;
                text-align: justify;
            }
            .cert-left h2 {
                padding: 0px;
            }
            .header-right {
                margin-top: -1cm;
            }
            .header-right img {
                margin-top: -1.5cm;
                height: 125px;
                float: right;
            }
        }

        @media screen {
            page[size="A4"] {
                padding: 1.5cm;
                font-size: 12px;
            }
        }

        ol {
            margin: 0px;
            padding: 0px;
        }

        li {
            line-height: 20px;
            padding-bottom: 20px;
            margin-left: 20px;
            margin-right: 10px;
            text-align: justify;
        }

        p {
            padding: 5px 10px;
            text-align: justify;
        }

        .cert-page {
            width: 100%;
        }

        .cert-header {
            width: 100%;
            display: block;
            clear: both;
            height: 130px;
        }

        .header-left {
            width: 20%;
            float: left;
            margin-top: -25px;
        }

        .header-left img {
            height: 116px;
        }

        .header-middle {
            width: 60%;
            /* margin-left:12.2%; */
            display: inline-block;
            text-align: center;
        }

        .header-middle h1 {
            font-size: 23px;
            margin: 0px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .header-middle h2 {
            font-size: 28px;
            font-weight: 700;
            padding: 0px;
            margin: 0px;
            text-transform: uppercase;
        }

        .header-right {
            width: 20%;
            float: right;
            margin-top: -25px;
        }

        .header-right img {
            height: 125px;
            float: right;
        }

        .cert-footer {
            width: 100%;
            display: block;
            background: #f4f4f4;
        }

        .cert-left {
            width: 45%;
            float: left;
        }

        .cert-left h2 {
            padding-left: 10px;
        }

        .cert-right {
            width: 45%;
            float: right;
        }

        .cert-right img {
            height: 60px;
            float: right;
            margin-right: 30px;
            text-align: center;
        }

        .sign-holder {
            float: right;
        }

        .cert-date,
        exe-gov-text {
            padding: 0px!important;
            margin: 0px;
            text-align: center;
        }
    </style>



</head>

<body>





<page size="A4">
    <div class="cert-header">



        <div class="header-left">


        <img src="{{ asset('img/imo-logo.png') }}" alt="imo State Government">


        </div>

        <div class="header-middle">

            <h1>Imo State Government Nigeria</h1>
            <h2>Certificate of Occupancy</h2>

        </div>

        <div class="header-right">
            @if ($document->getOwnerPassport())
                <img src="{{$document->getOwnerPassport()->file}}">
            @endif
        </div>
    </div>

    <div class="col-md-12">

        <div class="cert-body">

            <p> <b>Statutory {{$document->documentable_type}} No {{$document->document_id}}</b> <span>Page: 45</span> <span>Volume: 45</span></p>
            <p> THIS IS TO CERTIFY THAT <b> {{$document->getOwnerFullName()}}</b> hereinafter called the holder/holders which term shall include any person/persons defined as such in section 9 of the Land Use Act No.6 of 1978) is/are entitled
                to a right of occupancy in and over Plot <b>{{ $document->documentable->house_plot_number }}, {{ $document->documentable->street_name }}, {{ $document->documentable->city }}</b> in Block within <b>{{$document->documentable->dimension }}</b> Layout or in and over a parcel of land described in the schedule and more particularly delineated in the
            </p>

            <p> Plan No <b>{{$document->documentable->survey_plan_number }}</b> annexed hereto for a term <b>{{$document->documentable->term }}</b> years commencing from the 1st day of January, 2018 according to the true intent and meaning of the Land Use Act of No.6 of 1978 and subject to the provision
                thereof and to the following special terms and conditions hereinafter contained.
            </p>


            <ol>
                <li>To pay in advance without demand to the Governor or other person appointed by him yearly rent of <b>{{$document->documentable->yearly_rent_payable}}</b> on the first day of January in each year.</li>

                <li>The rent hereby reserved hall be revised at the end of every ten years of the <b>{{$document->documentable->type}}</b></li>

                <li>To pay and discharge all rates, assessments and impositions whatsoever which shall at any time be charged, assessed or imposed on the said land or any building thereon or upon the occupier or occupiers thereof.</li>

                <li>To erect and complete on the said land within <b>{{$document->documentable->development_period}}</b> years from the date of ncement of this right of occupancy, buildings or other work specified in the etailed plans approved by the Chief Land Officer or other
                    officer appointed by the Governor in that behalf.</li>

                <li>Such buildings or other works shall not be less than <b>#10,000,000.00</b> in value to the faction of and in accordance with plans approved by the Chief Land Officer or other officer appointed by the Governor in that behalf.</li>
                <li> To use the said land only for <b>{{$document->documentable->purpose_of_use}}</b> Purpose </li>
                <li>To maintain, in good and substantial repair to the satisfaction of the Chief Land Officer or other officer appointed by the Governor, all buildings or works in the said land either erected or to be erected pursuant to subsection 4
                    supra.
                </li>
                <li>To maintain good and substantial condition, all beacons and other landmarks by which the boundaries of the land comprised in this Certificate of Occupancy are defined and to clear and keep clear of the said land of all forms of refuse,
                    stagnant water, rank weeds, deposit of rubbish and to keep the same in all respects in a clean and sanitary condition and execute all such acts and works as the Governor or any other officer authorized by him may reasonably require</li>
                <li>To maintain good and substantial condition, all beacons and other landmarks by which the boundaries of the land comprised in this {{$document->documentable->type}} are defined and to clear and keep clear of the said land of all forms of refuse, stagnant
                    water, rank weeds, deposit of rubbish and to keep the same in all respects in a clean and sanitary condition and execute all such acts and works as the Governor or any other officer authorized by him may reasonably require</li>
                <li>Not to erect or build or permit to be erected or build on the said land any buildings other than those covenanted to be erected by virtue of this Certificate of Occupancy or to make or permit to be made any addition or alteration to
                    the said building erected or to be erected on the land except in accordance with the plans and specifications approved by the Chief Land Officer or other officer appointed by the Governor in that behalf.</li>
                <li> Not to alienate the right of occupancy hereby granted or any part thereof either by sale, assignment, mortgage sublease or otherwise howsoever without the consent in writing of the Governor first and obtained.</li>
            </ol>

        </div>



        <div class="cert-footer">

            <div class="cert-left">
                <h2>Date</h2>
                <p><span class="cert-date"> {{$document->document_id}} </span></p>
            </div>

            <div class="cert-right">
                <div class="sign-holder">
                    {{$document->document_id}}
                    <p class="exe-gov-text" style="text-align:center; padding-left: 0px;">Owelle Rochas Okorocha<br>Executive Governor</p>
                </div>
            </div>




        </div>


    </div>
</page>

</div>

</div>
<!--  end card  -->
</div>
<!-- end row -->


<!-- Button trigger modal -->




</div>
</div>







</body>



</html>
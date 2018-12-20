
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pay Slip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>



<div style="margin:5% 40% 0% 33%;float:left; width:500px; box-shadow:0 0 3px #aaa; height:auto;color:#666;">
    <div style="width:100%; padding:10px; float:left; background:#1ca8dd; color:#fff; font-size:30px; text-align:center;">
        Payslip
    </div>
    <div style="width:100%; padding:0px 0px;border-bottom:1px solid rgba(0,0,0,0.2);float:left;">
        <div style="width:30%; float:left;padding:10px;">

            <span style="font-size:14px;float:left; width:100%;">
                {{ $payroll->staff->name }}
            </span>
            <span style="font-size:14px;float:left;width:100%;">
                {{ $payroll->staff->address }}
            </span>
            <span style="font-size:14px;float:left;width:100%;">
			{{ $payroll->staff->email }}
			</span>
        </div>

        <div style="width:40%; float:right;padding:">
            <span style="font-size:14px;float:right;  padding:10px; text-align:right;">
                <b>Period: </b>January 2018
            </span>
            <span style="font-size:14px;float:right;  padding:10px; text-align:right;">
               <b>Invoice# : </b>SDO-{{ $payroll->id .'-'.$payroll->staff->id }}
            </span>
        </div>
    </div>





    <div style="width:100%; padding:0px; float:left;">

        <div style="width:100%;float:left;background:#efefef;">
            <span style="float:left; text-align:left;padding:10px;width:50%;color:#888;font-weight:600;">
            Decription
           </span>
            <span style="font-weight:600;float:left;padding:10px ;width:40%;color:#888;text-align:right;">
         Amount
        </span>
        </div>

        <div style="width:100%;float:left;">
            <span style="float:left; text-align:left;padding:10px;width:50%;color:#888;">
            Gross Salary


            <span style="font-size:10px; float:left; width:100%;">
                (Earned)
            </span>
        </span>
            <span style="font-weight:normal;float:left;padding:10px ;width:40%;color:#888;text-align:right;">
            GHS {{ $payroll->gross_salary }}
        </span>
        </div>


        <div style="width:100%;float:left;">
            <span style="float:left; text-align:left;padding:10px;width:50%;color:#888;">
            Tax Percentage
            <span style="font-size:10px; float:left; width:100%;">
                {{ $payroll->tax_percentage .'%'}}
            </span>
        </span>
            <span style="font-weight:normal;float:left;padding:10px ;width:40%;color:#888;text-align:right;">
            GHC {{ ($payroll->tax_percentage / 100) * $payroll->gross_salary }}
        </span>
        </div>


        {{--<div style="width:100%;float:left;">--}}
            {{--<span style="float:left; text-align:left;padding:10px;width:50%;color:#888;">--}}
            {{--Promotional Code--}}
            {{--<span style="font-size:10px; float:left; width:100%;">--}}
                {{--(0%)--}}
            {{--</span>--}}
        {{--</span>--}}
            {{--<span style="font-weight:normal;float:left;padding:10px ;width:40%;color:#888;text-align:right;">--}}
            {{--373 INR--}}
        {{--</span>--}}
        {{--</div>--}}

        <div style="width:100%;float:left; background:#fff;">

         <span style="font-weight:600;float:right;padding:10px 0px;width:40%;color:#666;text-align:center;">
           Net Salary : GHC {{  $payroll->net_salary }}
        </span>
        </div>

    </div>




</body>
</html>

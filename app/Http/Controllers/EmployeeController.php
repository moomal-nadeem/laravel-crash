<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    //
    public function findByRelation()
    {
        $employee = Employee::with('companyData')->find('eID',1);
        
        if ($employee) {
            return $employee->companyData;
        } else {
            return "Employee not found.";
        }
    }
    
    
}

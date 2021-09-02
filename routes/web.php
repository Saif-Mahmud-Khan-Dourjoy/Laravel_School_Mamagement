
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'PageController@index')->name('pages.index');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
	Route::get('/warning', 'HomeController@warning')->name('homes.warning');
	Route::get('/home', 'HomeController@index')->name('homes.index');

	//routes for area
	Route::resource('areas', 'AreaController');
	Route::resource('generalSettings', 'GeneralSettingsController');
	Route::get('/area/get-data-json', "AreaController@getDataForDataTable")->name('areas.getDataForDataTable');
	Route::resource('branches', 'BranchController');
	Route::get('/branch/get-data-json', "BranchController@getDataForDataTable")->name('branches.getDataForDataTable');
	Route::resource('shifts', 'ShiftController');
	Route::get('/shift/get-data-json', "ShiftController@getDataForDataTable")->name('shifts.getDataForDataTable');
	Route::resource('sessions', 'SessionController');
	Route::resource('terms', 'TermController');
	Route::get('/session/get-data-json', "SessionController@getDataForDataTable")->name('sessions.getDataForDataTable');
	Route::resource('teachers', 'TeacherController');
	Route::post('/teachers/update-status/{id}', 'TeacherController@updateStatus')->name('teachers.updateStatus');
	//update teacher

	Route::post('/teachers/basic_info/{id}',"TeacherController@updateBasicInfo")->name('update.teacherBasicInfo');

	Route::post('/teachers/bank_acc/{id}',"TeacherController@updateBank_accInfo")->name('update.teacherBank_accInfo');
	Route::post('/teachers/mbl_acc/{id}',"TeacherController@updateMbl_accInfo")->name('update.teacherMbl_accInfo');


	Route::post('/teachers/edu_info/{id}',"TeacherController@updateEdu_info")->name('update.edu_info');
	Route::get('/teachers/del_edu_info/{id}',"TeacherController@del_edu_info")->name('delete.edu_info');

	Route::post('/teachers/training_info/{id}',"TeacherController@updateTraining_info")->name('update.training_info');
	Route::get('/teachers/del_training_info/{id}',"TeacherController@del_training_info")->name('delete.training_info');
	
	Route::post('/teachers/prev_scl_info/{id}',"TeacherController@updatePrev_scl_info")->name('update.prev_scl_info');
	Route::get('/teachers/del_prev_scl_info/{id}',"TeacherController@del_prev_scl_info")->name('delete.prev_scl_info');

	Route::post('/teachers/ntrca_info/{id}',"TeacherController@updateNtrca_info")->name('update.ntrca_info');
	Route::get('/teachers/del_ntrca_info/{id}',"TeacherController@del_ntrca_info")->name('delete.ntrca_info');

	Route::post('/teachers/scale_chng_info/{id}',"TeacherController@updateScale_chng_info")->name('update.scale_chng_info');
	Route::get('/teachers/del_scale_changing_info/{id}',"TeacherController@del_scale_changing_info")->name('delete.scale_changing_info');
	
    //add more in update
	Route::post('/teachers/more_edu_info/{id}',"TeacherController@more_edu_info")->name('add.more_edu_info');
	Route::post('/teachers/more_training_info/{id}',"TeacherController@more_training_info")->name('add.more_training_info');
	Route::post('/teachers/more_prev_scl_info/{id}',"TeacherController@more_prev_scl_info")->name('add.more_prev_scl_info');
	Route::post('/teachers/more_ntrca_info/{id}',"TeacherController@more_ntrca_info")->name('add.more_ntrca_info');
	Route::post('/teachers/more_scale_change_info/{id}',"TeacherController@more_scale_change_info")->name('add.more_scale_change_info');
	Route::post('/teacher/update/password',"TeacherController@updatePassword")->name('password.update');
	


	Route::get('teacher/get-data-json', "TeacherController@getDataForDataTable")->name('teachers.getDataForDataTable');
	Route::resource('levels', 'LevelController');
	Route::get('/level/get-data-json', "LevelController@getDataForDataTable")->name('levels.getDataForDataTable');
	Route::resource('sections', 'SectionController');
	Route::get('/section/get-data-json', "SectionController@getDataForDataTable")->name('sections.getDataForDataTable');
	Route::resource('students', 'StudentController');
	Route::get('/student/create_old', "StudentController@create_old")->name('students.create_old');
	Route::post('/students/store_old', "StudentController@store_old")->name('students.store_old');

	Route::get('/student/get-data-json', "StudentController@getDataForDataTable")->name('students.getDataForDataTable');
	Route::resource('subjects', 'SubjectController');
	Route::get('/subject/get-data-json', "SubjectController@getDataForDataTable")->name('subjects.getDataForDataTable');
	
	//routes for publicExam
	Route::resource('publicExams', 'PublicExamController');
	Route::post('/publicExam/store/{id}', "PublicExamController@publicExamStore")->name('publicExamStore');

	//routes for result
	Route::post('/show-result', 'ResultController@showResult')->name('results.showResult');
	Route::resource('results', 'ResultController');
	Route::get('result/add/', 'ResultController@chooseTestNumber')->name('results.chooseTestNumber');
	Route::get('result/mark/', 'ResultController@showSubjects')->name('results.showSubjects');
	Route::get('/weekly_result', 'ResultController@weeklyResult')->name('results.weeklyResult');
	Route::get('/result/get-data-json',"ResultController@getDataForDataTable")->name('results.getDataForDataTable');
	Route::get('/result/view_by_test_number', "ResultController@viewByNumber")->name('results.viewByNumber');
	Route::get('/result/get_student/{id}', "ResultController@chooseNumber")->name('results.chooseNumber');

	//routes for levels
	Route::post('/level_enrolls', "LevelController@enrollment")->name('levels.enrollment');
	Route::post('level_enrolls_assign', 'LevelController@enrollment')->name('levels.enrollment');

	//routes for sections
	Route::get('/section/assign_student/{id}', "SectionController@assignStudent")->name('sections.assignStudent');
	Route::post('/section/save_student', "SectionController@saveStudents")->name('sections.saveStudents');
	Route::get('/section/assign_subject/{id}', "SectionController@assignSubject")->name('sections.assignSubject');

	Route::get('/section_student/view_attendance/{section_id}',"SectionStudentController@viewAttendance")->name('section_student.viewAttndance');
	// Route::get('/pdf/attendance_report/{section_id}','ReportController@pdfAttendanceReport')->name('attendance.pdfAttendanceReport');
	Route::get('/search/attendance_report','SectionStudentController@searchAttendanceIndex')->name('attendanceReport.search');
	Route::post('/search/attendance_report/view','SectionStudentController@searchedAttendanceView')->name('attendanceReport.view');

	Route::get('/search/collection-report','CollectionReportController@index')->name('collectionReport.search');
	Route::post('/search/collection-report/view','CollectionReportController@collectionReportView')->name('collectionReport.view');

	Route::post('/section/save_subject', "SectionController@saveSubject")->name('sections.saveSubject');

	//routes for term results
	Route::get('/term_results', "TermResultController@searchForTermResult")->name('term_results.searchForTermResult');
	Route::get('/blank_result', "TermResultController@searchForBlankResult")->name('blank_result.searchForTermResult');
	Route::post('/blank_result/generate', "TermResultController@view_subjects")->name('blank_result.generate');
	Route::post('/blank_result/pdf', "TermResultController@blankResultPdf")->name('blank_result.pdf');
	Route::post('/term_results/view_students', "TermResultController@showStudents")->name('term_results.showStudents');
	Route::post('/term_results/submit', "TermResultController@viewAll")->name('term_results.viewAll');
	Route::post('/term_results/generateTermResult', "TermResultController@generateTermResult")->name('term_results.generateTermResult');
	Route::post('/term_results/submitTermResult', "TermResultController@submitTermResult")->name('term_results.submitTermResult');
	Route::post('/term_results/students', "TermResultController@viewStudents")->name('term_results.viewStudents');
	Route::post('/term_results/student/view', "TermResultController@singleView")->name('term_results.single-view');
	//routes for weekly tests
	Route::resource('weeklytests', 'WeeklyTestController');
	Route::post('/weekly_test/view_subjects/', "WeeklyTestController@showSubjects")->name('weeklyTests.showSubjects');
	Route::get('/weekly_test/proceed/', "WeeklyTestController@proceedWithSubject")->name('weeklyTests.proceedWithSubject');
	Route::get('/weekly_test/mark', "WeeklyTestController@proceedWithTestNumber")->name('weeklyTests.proceedWithTestNumber');
	Route::get('/weekly_tests/subjectWise', "WeeklyTestController@subjectWiseResult")->name('weeklyTests.subjectWiseResult');
	Route::get('/weekly_test/view_subject_wise_result/', "WeeklyTestController@viewSubjectWiseResult")->name('weeklyTests.viewSubjectWiseResult');
	Route::get('/weekly_test/view_by_number/{id}', "WeeklyTestController@viewNumberWiseResult")->name('weeklyTests.viewNumberWiseResult');
	Route::get('/weeklytest_updateMarks', "WeeklyTestController@updateMarks")->name('weeklyTests.updateMarks');
	Route::get('/weeklytest/deleteResult', "WeeklyTestController@deleteResult")->name('weeklyTests.deleteResult');
	Route::get('/weeklytest/storeMarks', "WeeklyTestController@storeMarks")->name('weeklyTests.storeMarks');
	Route::get('/weekly_test/proceed_with_student_id/', "WeeklyTestController@viewStudentWiseResult")->name('weeklyTests.viewStudentWiseResult');
	Route::get('/weekly_test/generate_term_result', "WeeklyTestController@generateTermResult")->name('weeklyTests.generateTermResult');
	Route::get('/weekly_test/regenerate_term_result', "WeeklyTestController@reGenerateTermResult")->name('weeklyTests.reGenerateTermResult');
	Route::post('/weekly_test/view_term_result/', "WeeklyTestController@viewTermResult")->name('weeklyTests.viewTermResult');
	Route::resource('termresults', 'TermResultController');
	Route::get('/view_report', "WeeklyTestController@viewTermReport")->name('weeklyTests.viewTermReport');

	//routes for level enroll
	Route::get('/level_enroll/get-data-json', "LevelEnrollController@getDataForDataTable")->name('levelEnrolls.getDataForDataTable');
	Route::resource('levelEnrolls', 'LevelEnrollController');
	Route::get('/section_student/get-data-json',"WeeklyTestController@getDataForDataTable")->name('weeklytests.getDataForDataTable');
	Route::get('/term/get-data-json',"TermController@getDataForDataTable")->name('terms.getDataForDataTable');
	
	Route::get('/pdf', "WeeklyTestController@downloadPDF")->name('weeklytests.downloadPDF');
	Route::get('/wt_pdf/{id}', "WeeklyTestController@download_wt_pdf")->name('weeklytests.download_wt_pdf');

	//routes for Student Statistics
	Route::get('/student-Statistics', "ReportController@statistics_index")->name('generate.student_Statistics');
	Route::get('/student-Statistics-pdf', "ReportController@statistics_pdf")->name('student_Statistics.pdf');
	//routes for weekly test report
	Route::get('/wt_report', "WeeklyTestController@wt_report")->name('weeklytests.wt_report');
	Route::get('/wt_report/view_students', "WeeklyTestController@viewStudents")->name('weeklytests.viewStudents');
	Route::get('/wt_report/pdf', "WeeklyTestController@view_wt_report")->name('weeklytests.view_wt_report');

	Route::resource('sectionStudents', 'SectionStudentController');
	Route::get('/section_enroll/get-data-json',"SectionStudentController@getDataForDataTable")->name('sectionStudents.getDataForDataTable');
	Route::resource('sectionSubjectTeachers', 'SectionSubjectTeacherController');
	Route::get('/section_subject_enroll/get-data-json',"SectionSubjectTeacherController@getDataForDataTable")->name('sectionSubjectTeachers.getDataForDataTable');

	Route::get('/pdf/report-weekly-test/{id}','ReportController@weeklyTest')->name('reports.weeklyTest');

	Route::resource('accounts', 'AccountController');
	Route::get('/account/get-data-json',"AccountController@getDataForDataTable")->name('accounts.getDataForDataTable');

	Route::resource('final_reports', "FinalReportController");

	//routes for final report
	Route::get('/final_report/view_students', "FinalReportController@viewStudents")->name('finalReports.viewStudents');
	Route::get('/final_report/process_students', "FinalReportController@processStudents")->name('finalReports.processStudents');
	Route::get('/final_report/reprocess_students', "FinalReportController@reProcessStudents")->name('finalReports.reProcessStudents');
	Route::get('/final_report_view/process_student/{id}', "FinalReportController@processSpecificStudents")->name('finalReports.processSpecificStudents');
	Route::get('/pdf/report-final/{id}','ReportController@pdfReportFinal')->name('finalReports.reportPdfFinal');

	//routs for fiscal year
	Route::resource('fiscal_years', 'FiscalYearController');
	Route::get('/fiscal_year/get-data-json',"FiscalYearController@getDataForDataTable")->name('fiscalYears.getDataForDataTable');

	Route::resource('business_months', 'BusinessMonthController');
	Route::get('/business_month/get-data-json',"BusinessMonthController@getMonthDataForDataTable")->name('businessMonths.getMonthDataForDataTable');

	Route::resource('fees_books', 'FeesBookController');
	Route::post('fees_book/check', 'FeesBookController@checkPrefixLeaf')->name('feesBooks.checkPrefixLeaf');
	Route::get('/fees_book/get-data-json',"FeesBookController@getDataForDataTable")->name('feesBooks.getDataForDataTable');

	Route::resource('fees_types', 'FeesTypeController');
	Route::get('/fees_type/get-data-json',"FeesTypeController@getDataForDataTable")->name('feesTypes.getDataForDataTable');

	Route::resource('section_wise_fees', 'SectionWiseFeesController');
	Route::get('/section_wise_fee/get-data-json',"SectionWiseFeesController@getDataForDataTable")->name('sectionWiseFees.getDataForDataTable');

	Route::post('sectionwisefees_getclass',"SectionWiseFeesController@getClass")->name('sectionwisefees.getclass');

	// Route::post('test',"SectionWiseFeesController@test");
	Route::post('/get_data',"ajaxController@data");
	Route::post('/get_section',"ajaxController@get_section");
	Route::post('/get_student',"ajaxController@get_student");



	Route::resource('payment_methods', 'PaymentMethodController');
	Route::get('/payment_method/get-data-json',"PaymentMethodController@getDataForDataTable")->name('paymentMethods.getDataForDataTable');

	//routes for collected fees
	Route::resource('collected_fees', 'CollectedFeesController');
	Route::get('/collected_fee/invoice/{id}', 'CollectedFeesController@pdfInvoice')->name('collectedFees.pdfInvoice');
	Route::post('/collected_fee/calculate', 'CollectedFeesController@calculateFees')->name('collectedFees.calculateFees');
	Route::get('/collected_fee/get-data-json',"CollectedFeesController@getDataForDataTable")->name('collectedFees.getDataForDataTable');
	Route::get('collected_fee/import', 'CollectedFeesController@import')->name('collectedFees.import');
	Route::post('collected_fee/import', 'CollectedFeesController@importFile')->name('collectedFees.importFile');	

	Route::get('/monthly_fees',"ReportController@monthlyFeesCollectionIndex")->name('monthlyFeesCollection.index');
	Route::post('/monthly_collection_report',"ReportController@monthlyCollectionReport")->name('monthlyCollectionReport.view');

	Route::resource('categories', 'CategoryController');
	Route::get('/category/get-data-json',"CategoryController@getDataForDataTable")->name('categories.getDataForDataTable');

	Route::resource('suppliers', 'SupplierController');
	Route::get('/supplier/get-data-json',"SupplierController@getDataForDataTable")->name('suppliers.getDataForDataTable');

	Route::resource('vouchers', 'VoucherController');
	Route::get('/voucher/get-data-json',"VoucherController@getDataForDataTable")->name('vouchers.getDataForDataTable');

	Route::resource('financial_reports', 'FinancialReportController');


	
	Route::post('financial_report/generate_report', 'FinancialReportController@generate_report')->name('financialReports.generate_report');

	Route::post('financial_report/month_wise_report', 'FinancialReportController@monthWiseReport')->name('financialReports.monthWiseReport');
	Route::post('financial_report/year_wise_report', 'FinancialReportController@yearWiseReport')->name('financialReports.yearWiseReport');
	Route::post('financial_report/student_wise_report', 'FinancialReportController@studentWiseReport')->name('financialReports.studentWiseReport');
	Route::get('/payment_history/get-data-json',"FinancialReportController@getDataForDataTable")->name('finalReports.getDataForDataTable');

	Route::resource('prefixes', 'PrefixController');
	Route::get('/prefix/get-data-json',"PrefixController@getDataForDataTable")->name('prefixes.getDataForDataTable');

	Route::get('/pdf/student-financial-history/{id}', 'FinancialReportController@studentWiseReportView')->name('finalReports.studentWiseReportView');
	Route::resource('roles', 'RoleController');
	Route::get('/role/get-data-json', "RoleController@getDataForDataTable")->name('roles.getDataForDataTable');

	Route::resource('permissions', 'PermissionController');
	Route::get('/permission/get-data-json', "PermissionController@getDataForDataTable")->name('permissions.getDataForDataTable');

	Route::resource('users', 'UserController');
	Route::get('/user/get-data-json', "UserController@getDataForDataTable")->name('users.getDataForDataTable');
	//routes for changing passwords for teachers
	Route::post('/change-password', 'TeacherController@changePassword')->name('teachers.changePassword');

	//routes for changing passwords for other users
	Route::post('/profile/change-password', 'UserController@changePassword')->name('users.changePassword');

	//attendance device
	Route::get('attendancedevices/get-data-json', "AttendancedeviceController@GetListForDataTable")->name('Attendancedevice.getDataForDataTable');
	Route::resource('attendancedevices','AttendancedeviceController');

	//routes for sms module
	Route::get('sms-notification', 'SmsController@index')->name('smsNotification');
	Route::post('sms-notification/load-info', 'SmsController@loadSmsInfo')->name('sms.loadInfo');
	Route::post('sms-notification/send', 'SmsController@sendSms')->name('sms.send');

	//expected collection
	Route::resource('expectedCollections', 'ExpectedCollectionController');
	Route::resource('notification-receivers', 'NotificationReceiverController');
	Route::resource('occasional-notifications', 'OccasionalNotificationController');

	//transfer certificate
	Route::get('transfer-certificate/index', 'TransferCertificateController@index')->name('transfer-certificate.index');
	Route::get('testmonial/index', 'TransferCertificateController@testimonial_index')->name('testimonial.index');
	Route::get('studentship-certificate/index', 'TransferCertificateController@studentship_index')->name('studentship.index');

	Route::get('admit-card/index', 'TransferCertificateController@admitCard_index')->name('admitCard.index');
	
	Route::post('transfer-certificate/pdf', 'TransferCertificateController@load_transfer_certificate')->name('transfer-certificate.pdf');
	Route::post('testmonial/pdf', 'TransferCertificateController@load_testimonial')->name('testmonial.pdf');
	Route::post('studenship-certificate/pdf', 'TransferCertificateController@load_studentship_certificate')->name('studentship-certificate.pdf');
	Route::post('admit_card/pdf', 'TransferCertificateController@load_admit_card')->name('admit_card.pdf');

	//Route::get('students_statistic/pdf', 'TransferCertificateController@load_student_statistic')->name('students.statistic.pdf');

	//Attendance System

	Route::get('attendance_select_form', "AttendanceStatusController@index")->name('index.attendance.select.form');
	Route::post('attendance_dashboard', "AttendanceStatusController@dashboard")->name('attendance.dashboard');
	Route::post('attendance_status', "AttendanceStatusController@store")->name('attendance.store');
	Route::post('attendance/delete/{id}', "AttendanceStatusController@delete")->name('attendance.delete');

	//Attendance report
	// Route::post('attendance/view-data', "AttendanceStatusController@viewAttendance")->name('attendance.view-data');
	Route::post('/pdf/attendance_report','ReportController@pdfAttendanceReport')->name('attendance.pdfAttendanceReport');
});


Route::group(['middleware' => 'AttendanceApi'], function(){
	Route::get('AttendanceApi/GetDeviceConfig', "AttendancedeviceController@deviceList")->name('Attendancedevice.device');
	Route::get('Attendance/AttendancesProcessByZktImporter', "AttendancedeviceController@processData")->name('Attendancedevice.process');

	Route::post('AttendanceApi/ImportAttendanceDeviceData', "AttendancedeviceController@importData")->name('Attendancedevice.import');

});

Route::get('/testSms', function(){
	$sms = new \App\Helpers\ELITBUZZSmsAPI;
	$message = "Test with invalid number";
	$message .= env('APP_NAME');
	return $sms->send(['01844527152','01534302690'] , $message, 'text');

	//$month = \Carbon\Carbon::today()->format('m');
	//$smsLogs = \App\SmsLog::with('notification_type')->whereMonth('created_at', $month)->get();
	//dd($smsLogs);
});



<?php 

require "uuidCreate.php";
require "sayiyiYaziyaCevir.php";
require "KolaysoftInvoice/inputDocumet.php";


// 
$time = date('H:i:s');
$date = date_create();
$invoice_date = date_format($date, 'Y-m-d');
$order_id =  rand(10000, 90000);
$total_price = 400232.232;
$yaziyla = 'Yalnız ' . sayiyiYaziyaCevir($total_price, 2, "TL,", "Kuruş", "#", null, null, null);
$urun_sayi = 1;

// 
$UUIDnum = uuidv4();
$Fatura_ID  = 'ABC' . date_format($date, 'Ymd') . $order_id;
$Copy_Indicator  = 'false';

// Configrasyon VKN_TCKN , VKN
$VKN_TCKN = '5750464002';
$VKN = '0102056568';

// Customer config
$Customer_TCKN = '11111111111';
$Customer_CitySubdivisionName = 'Çankaya';
$Customer_CityName = 'Ankara';
$Customer_Country = 'Türkiye';
$Customer_Name = 'test';
$Customer_LastName = 'testsurname';


$xmlContent = file_get_contents("e_arsiv_invoice.xml");
$destinationUrn = "mustafa9889.ma@gmail.com";
$documentDate = $invoice_date;
$documentUUID = '';
$sourceUrn = "urn:mail:defaultgb@sahanekitap.com.tr";
$localId = "ABC-123";
$documentId = $Fatura_ID;
$inputDocument = new InputDocument($xmlContent, $destinationUrn, $documentDate, $documentUUID, $sourceUrn, $localId, $documentId);

// Cart cofig
$Products = 'test ürün'; 

// Amount config
$Vergi_Amount = 0.18;
$Cart_Total= 1;
$Amounts_Payable = 1.18;
$Vergi_Percent = 18;
$TaxCategory_Name = 'GERÇEK USULDE KATMA DEĞER VERGİSİ';
$TaxTypeCode = '0015';
$AllowanceTotalAmount = 0.00;

// Invoice config
$InvoiceLine = 1;
$InvoicedQuantity = 1;


// Ubl config
$UBLVersion_ID = '2.1';

$Customization_ID = 'TR1.2';
$Profile_ID = 'EARSIVFATURA';


$Issue_Date  = $invoice_date;
$Issue_Time  = $time;
$InvoiceType_Code = 'SATIS';
$Note_Yaziyla = $yaziyla;
$DocumentCurrenc_Code = 'TRY';
$LineCountNumeric = $urun_sayi;

// AdditionalDocumentReferance config
$AdditionalDocumentReference_ID = uuidv5();
$AdditionalDocumentReference_IssueDate =  $invoice_date;
$AdditionalDocumentReference_DocumentTypeCode = 'GONDERIM_SEKLI';
$AdditionalDocumentReference_DocumentType = 'ELEKTRONIK';

// AdditionalDocumentReferance2 config
$AdditionalDocumentReference_ID2 = uuidv6();


// Signature config
$Signature_ID_VKN_TCKN = $VKN_TCKN ;
$SignatoryParty_PartyIdentification_ID = $VKN_TCKN;
$SignatoryParty_PostalAddress_Room = '201-204';
$SignatoryParty_StreetName = 'A.T.G.B. Üniversiteler Mah. 1605. Cad.';
$SignatoryParty_BuildingName = 'Cyberpark Vakıf Binası';
$SignatoryParty_BuildingNumber = '3';
$SignatoryParty_CitySubdivisionName = 'Çankaya';
$SignatoryParty_CityName = 'Ankara';
$SignatoryParty_PostalZone = '06800';
$SignatoryParty_Country_Name = 'Türkiye';
$Signature_ExternalReference_URI = '#Signature_' . $UUIDnum;

// AccountingSupplierParty config
$AccountingSupplierParty_PartyIdentification_ID = $VKN;
$AccountingSupplierParty_PartyName = 'Sahane Kitap';
$AccountingSupplierParty_PostalAddress_CitySubdivisionName = 'Çankaya';
$AccountingSupplierParty_PostalAddress_CityName = 'Ankara';
$AccountingSupplierParty_PostalAddress_Country = 'Türkiye';
$AccountingSupplierParty_PartyTaxScheme_Name = 'DİKİMEVİ VERGİ DAİRESİ MÜDÜRLÜĞÜ';
$AccountingSupplierParty_Contact_ElectronicMail = 'ozgur.ari@kolaysoft.com.tr';

// AccountingCustomerParty config
$AccountingCustomerParty_PartyIdentificatio_TCKN = $Customer_TCKN;
$AccountingCustomerParty_PostalAddress_CitySubdivisionName = $Customer_CitySubdivisionName;
$AccountingCustomerParty_PostalAddress_CityName = $Customer_CityName;
$AccountingCustomerParty_PostalAddress_Country =$Customer_Country;
$AccountingCustomerParty_Customer_FirstName = $Customer_Name;
$AccountingCustomerParty_Customer_LastName = $Customer_LastName;

// AllowanceCharge config
$AllowanceCharge_ChargeIndicator = 'false';
$AllowanceCharge_Amount = 0;

// TaxTotal config
$TaxTotal_TaxAmount  = $Vergi_Amount;
$TaxTotal_TaxSubtotal_TaxableAmount = $Cart_Total;
$TaxTotal_TaxSubtotal_TaxAmount = $Vergi_Amount;
$TaxTotal_TaxSubtotal_Percent = $Vergi_Percent;
$TaxTotal_TaxScheme_Name = $TaxCategory_Name;
$TaxTotal_TaxTypeCode = $TaxTypeCode;

// LegalMonetaryTotal config
$LegalMonetaryTotal_LineExtensionAmount = $Cart_Total;
$LegalMonetaryTotal_TaxExclusiveAmount = $Cart_Total;
$LegalMonetaryTotal_TaxInclusiveAmount = $Amounts_Payable;
$LegalMonetaryTotal_AllowanceTotalAmount = $AllowanceTotalAmount;
$LegalMonetaryTotal_PayableAmount = $Amounts_Payable;


// InvoiceLine config
$InvoiceLine_ID = $InvoiceLine;
$InvoiceLine_InvoicedQuantity = $InvoicedQuantity ;
$InvoiceLine_LineExtensionAmount = $Cart_Total;
$InvoiceLine_TaxTotal_TaxAmount = $Vergi_Amount;
$InvoiceLine_TaxSubtotal_TaxableAmount = $Cart_Total;
$InvoiceLine_TaxSubtotal_TaxAmount = $Vergi_Amount;
$InvoiceLine_TaxSubtotal_Percent = $Vergi_Percent;
$InvoiceLine_TaxCategory_Name  = $TaxCategory_Name;
$InvoiceLine_TaxTypeCode = $TaxTypeCode;
$InvoiceLine_Item_Name = $Products;
$InvoiceLine_Price = $Cart_Total;


?>
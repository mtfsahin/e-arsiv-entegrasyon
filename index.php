<?php

require 'KolaysoftInvoice/inputDocumet.php';

// Fatura nesnesi oluşturma
$doc = new DOMDocument('1.0', 'UTF-8');
$doc->formatOutput = true;

$urn = 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2';
$urna = 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2';

// Fatura kök düğümü oluşturma
$invoice = $doc->createElementNS('urn:oasis:names:specification:ubl:schema:xsd:Invoice-2', 'Invoice');
$invoice->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
$invoice->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
$invoice->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:ext', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');

$doc->appendChild($invoice);

// UBLNamespaces nesnesi oluşturma ve namespace'leri ekleyerek kök düğüme ekleme
$UBLExtensions = $doc->createElementNS('urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2', 'UBLExtensions');
$invoice->appendChild($UBLExtensions);

$UBLExtension = $doc->createElementNS('urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2', 'UBLExtension');
$UBLExtensions->appendChild($UBLExtension);

$ExtensionContent = $doc->createElementNS('urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2', 'ext:ExtensionContent');
$UBLExtension->appendChild($ExtensionContent);

$auto_generated_wildcard = $doc->createElement('auto-generated-wildcard');
$ExtensionContent->appendChild($auto_generated_wildcard);


$UBLVersionID = $doc->createElementNS($urn, 'cbc:UBLVersionID', '2.1');
$invoice->appendChild($UBLVersionID);

$CustomizationID = $doc->createElementNS($urn, 'cbc:CustomizationID', 'TR1.2');
$invoice->appendChild($CustomizationID);

// ProfileID
$ProfileID = $doc->createElementNS($urn, 'cbc:ProfileID', 'EARSIVFATURA');
$invoice->appendChild($ProfileID);

// ID alanı değişecek
$ID = $doc->createElementNS($urn, 'cbc:ID', 'ABC2023030656789');
$invoice->appendChild($ID);

// CopyIndicator
$CopyIndicator = $doc->createElementNS($urn, 'cbc:CopyIndicator', 'false');
$invoice->appendChild($CopyIndicator);

// IssueDate
$IssueDate = $doc->createElementNS($urn, 'cbc:IssueDate', '2023-03-10');
$invoice->appendChild($IssueDate);

// InvoiceTypeCode
$InvoiceTypeCode = $doc->createElementNS($urn, 'cbc:InvoiceTypeCode', 'SATIS');
$invoice->appendChild($InvoiceTypeCode);

// DocumentCurrencyCode
$DocumentCurrencyCode = $doc->createElementNS($urn, 'cbc:DocumentCurrencyCode', 'TRY');
$invoice->appendChild($DocumentCurrencyCode);

// AccountingSupplierParty
$AccountingSupplierParty = $doc->createElementNS($urna, 'cac:AccountingSupplierParty');
$invoice->appendChild($AccountingSupplierParty);

// Party
$Party = $doc->createElementNS($urna, 'cac:Party');
$AccountingSupplierParty->appendChild($Party);


// PartyIdentification
$PartyIdentification = $doc->createElementNS($urna, 'cac:PartyIdentification');
$AccountingSupplierParty->appendChild($PartyIdentification);
$ID = $doc->createElementNS($urn, 'cbc:ID', '12345');
$PartyIdentification->appendChild($ID);

// PartyName
$PartyName = $doc->createElementNS($urna, 'cac:PartyName');
$AccountingSupplierParty->appendChild($PartyName);
$Name = $doc->createElementNS($urn, 'cbc:Name', 'Mustafa');
$PartyName->appendChild($Name);

// PartyLegalEntity
$PartyLegalEntity = $doc->createElementNS($urna, 'cac:PartyLegalEntity');
$AccountingSupplierParty->appendChild($PartyLegalEntity);
$RegistrationName = $doc->createElementNS($urn, 'cbc:RegistrationName', 'Mustafa');
$PartyLegalEntity->appendChild($RegistrationName);

// AccountingCustomerParty
$AccountingCustomerParty = $doc->createElementNS($urna, 'cac:AccountingCustomerParty');
$invoice->appendChild($AccountingCustomerParty);

// Party
$Party = $doc->createElementNS($urna, 'cac:Party');
$AccountingCustomerParty->appendChild($Party);

// PartyIdentification
$PartyIdentification = $doc->createElementNS($urna, 'cac:PartyIdentification');
$Party->appendChild($PartyIdentification);
$ID = $doc->createElementNS($urn, 'cbc:ID', '12345');
$PartyIdentification->appendChild($ID);

// PartyName
$PartyName = $doc->createElementNS($urna, 'cac:PartyName');
$Party->appendChild($PartyName);
$Name = $doc->createElementNS($urn, 'cbc:Name', 'alıcımustafa');
$PartyName->appendChild($Name);

// PartyLegalEntity
$PartyLegalEntity = $doc->createElementNS($urna, 'cac:PartyLegalEntity');
$Party->appendChild($PartyLegalEntity);
$RegistrationName = $doc->createElementNS($urn, 'cbc:RegistrationName', 'alıcımustafa');
$PartyLegalEntity->appendChild($RegistrationName);


// TaxTotal
$TaxTotal = $doc->createElementNS($urna, 'cac:TaxTotal');
$invoice->appendChild($TaxTotal);

// TaxAmount
$TaxAmount = $doc->createElementNS($urn, 'cbc:TaxAmount', '1000.00');
$TaxTotal->appendChild($TaxAmount);

// TaxSubtotal
$TaxSubtotal = $doc->createElementNS($urna, 'cac:TaxSubtotal');
$TaxTotal->appendChild($TaxSubtotal);

// TaxableAmount
$TaxableAmount = $doc->createElementNS($urn, 'cbc:TaxableAmount', '5000.00');
$TaxSubtotal->appendChild($TaxableAmount);

// TaxCategory
$TaxCategory = $doc->createElementNS($urna, 'cac:TaxCategory');
$TaxSubtotal->appendChild($TaxCategory);

// TaxScheme
$TaxScheme = $doc->createElementNS($urna, 'cac:TaxScheme');
$TaxCategory->appendChild($TaxScheme);

// ID
$ID = $doc->createElementNS($urn, 'cbc:ID', '0015');
$TaxScheme->appendChild($ID);

// Name
$Name = $doc->createElementNS($urn, 'cbc:Name', 'KDV');
$TaxScheme->appendChild($Name);

// TaxTypeCode
$TaxTypeCode = $doc->createElementNS($urn, 'cbc:TaxTypeCode', '0015');
$TaxCategory->appendChild($TaxTypeCode);

// LegalMonetaryTotal
$LegalMonetaryTotal = $doc->createElementNS($urna, 'cac:LegalMonetaryTotal');
$invoice->appendChild($LegalMonetaryTotal);

// LineExtensionAmount
$LineExtensionAmount = $doc->createElementNS($urn, 'cbc:LineExtensionAmount', '5000.00');
$LegalMonetaryTotal->appendChild($LineExtensionAmount);

// TaxExclusiveAmount
$TaxExclusiveAmount = $doc->createElementNS($urn, 'cbc:TaxExclusiveAmount', '4000.00');
$LegalMonetaryTotal->appendChild($TaxExclusiveAmount);

// TaxInclusiveAmount
$TaxInclusiveAmount = $doc->createElementNS($urn, 'cbc:TaxInclusiveAmount', '110.00');
$TaxInclusiveAmount->setAttribute('currencyID', 'TRY');
$LegalMonetaryTotal->appendChild($TaxInclusiveAmount);

// LegalMonetaryTotal (Invoice düğümü içinde)
$LegalMonetaryTotal = $doc->createElementNS($urna, 'cac:LegalMonetaryTotal');
$invoice->appendChild($LegalMonetaryTotal);

// LineExtensionTotal
$LineExtensionTotal = $doc->createElementNS($urn, 'cbc:LineExtensionTotal', '100.00');
$LineExtensionTotal->setAttribute('currencyID', 'TRY');
$LegalMonetaryTotal->appendChild($LineExtensionTotal);

// TaxExclusiveAmount
$TaxExclusiveAmount = $doc->createElementNS($urn, 'cbc:TaxExclusiveAmount', '100.00');
$TaxExclusiveAmount->setAttribute('currencyID', 'TRY');
$LegalMonetaryTotal->appendChild($TaxExclusiveAmount);

// TaxInclusiveAmount
$TaxInclusiveAmount = $doc->createElementNS($urn, 'cbc:TaxInclusiveAmount', '110.00');
$TaxInclusiveAmount->setAttribute('currencyID', 'TRY');
$LegalMonetaryTotal->appendChild($TaxInclusiveAmount);

// PayableAmount
$PayableAmount = $doc->createElementNS($urn, 'cbc:PayableAmount', '110.00');
$PayableAmount->setAttribute('currencyID', 'TRY');
$LegalMonetaryTotal->appendChild($PayableAmount);

// convert the XML object to string
$xmlString = $doc->saveXML();

echo($xmlString);

$file_path = 'faturanew.xml';
$file = fopen($file_path, 'w');

$xml_content = $doc->saveXML();

fwrite($file, $xml_content);
fclose($file);

echo("Dosya içine kaydedildi..");


function earsiv_fatura(){
    try {
        // Kullanıcı adı ve şifre
        $username = 'admin_002874';
        $password = ')xrd9!iX';

        // SOAP bağlantısı kurulur
        $client = new SoapClient("https://servis.kolayentegrasyon.net/EArchiveInvoiceService/EArchiveInvoiceWS?wsdl", array(
            'soap_version' => SOAP_1_2,
            'stream_context' => stream_context_create(array(
                'http' => array(
                    'header' => "Username: $username\r\nPassword: $password\r\n",
                ),
            )),
        ));
        
        // Fatura bilgileri oluşturulur
        $document = new InputDocument();
        $document->xmlContent = file_get_contents('fatura.xml');
        $document->destinationUrn = 'mustafa9889.ma@gmail.com';
        $document->documentDate = '2023-03-06';
        $document->documentUUID = 'abf8a880-aa37-40bb-8527-569cff5f659e';
        $document->sourceUrn = 'urn:mail:defaultgb@sahanekitap.com.tr';
        $document->localId = 'ABC-123';
        $document->documentId = 'ABC2023030656789';

        // Fatura gönderme işlemi gerçekleştirilir
        $response = $client->sendInvoice([$document]);

        // Yanıt işlenir
        foreach ($response as $res) {

            echo 'İşlem kodu: ' . $res->code . '<br>' .  $res->document_uuid ;
            echo 'Açıklama: ' . $res->explanation . '<br>';

            if (isset($res->cause)) {
                echo 'Hata sebebi: ' . $res->cause . '<br>';
            }
            echo '<br>';
        }
    } catch (\Exception $e) {
        echo 'Şuan işleminiz gerçekleştirilemiyor, lütfen daha sonra tekrar deneyiniz.';
    }
}



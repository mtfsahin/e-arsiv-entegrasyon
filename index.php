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

// ID alanı değişecek - generate -yıl+ay+gun+random
$ID = $doc->createElementNS($urn, 'cbc:ID', 'ABC2023030656789');
$invoice->appendChild($ID);

// CopyIndicator
$CopyIndicator = $doc->createElementNS($urn, 'cbc:CopyIndicator', 'false');
$invoice->appendChild($CopyIndicator);

// UUID eklendi
$UUID = $doc->createElementNS($urn, 'cbc:UUID', 'abf8a880-aa37-40bb-8527-569cff5f659e');
$invoice->appendChild($UUID);

// IssueDate
$IssueDate = $doc->createElementNS($urn, 'cbc:IssueDate', '2023-03-10');
$invoice->appendChild($IssueDate);

// IssueTime eklendi
$IssueTime = $doc->createElementNS($urn, 'cbc:IssueTime', '13:44:22');
$invoice->appendChild($IssueTime);

// InvoiceTypeCode
$InvoiceTypeCode = $doc->createElementNS($urn, 'cbc:InvoiceTypeCode', 'SATIS');
$invoice->appendChild($InvoiceTypeCode);

// Note eklendi
$Note = $doc->createElementNS($urn, 'cbc:Note', 'Yalnız #Bir TL, OnSekiz Kr#');
$invoice->appendChild($Note);


// DocumentCurrencyCode
$DocumentCurrencyCode = $doc->createElementNS($urn, 'cbc:DocumentCurrencyCode', 'TRY');
$invoice->appendChild($DocumentCurrencyCode);

// LineCountNumeric eklendi
$LineCountNumeric = $doc->createElementNS($urn, 'cbc:LineCountNumeric', '1');
$invoice->appendChild($LineCountNumeric);



// AdditionalDocumentReference elemanını oluşturuldu ve eklendi
$additionalDocRef = $doc->createElementNS($urna, 'cac:AdditionalDocumentReference');
$invoice->appendChild($additionalDocRef);

$id = $doc->createElementNS($urn, 'cbc:ID', 'a1bc7e63-87e0-46b0-bc5b-5107e652dc5b');
$additionalDocRef->appendChild($id);

$issueDate = $doc->createElementNS($urn, 'cbc:IssueDate', '2023-03-05');
$additionalDocRef->appendChild($issueDate);

$docTypeCode = $doc->createElementNS($urn, 'cbc:DocumentTypeCode', 'GONDERIM_SEKLI');
$additionalDocRef->appendChild($docTypeCode);

$docType = $doc->createElementNS($urn, 'cbc:DocumentType', 'ELEKTRONIK');
$additionalDocRef->appendChild($docType);

$invoice->appendChild($additionalDocRef);

// additionalDocumentReference elemanını oluşturuldu ve eklendi
$additionalDocumentReference = $doc->createElementNS($urna, 'cac:AdditionalDocumentReference');
$invoice->appendChild($additionalDocumentReference);

$ID = $doc->createElementNS($urn, 'cbc:ID', 'a1bc7e63-87e0-46b0-bc5b-5107e652dc5b');
$additionalDocumentReference->appendChild($ID);

$issueDate = $doc->createElementNS($urn, 'cbc:IssueDate', '2023-03-05');
$additionalDocumentReference->appendChild($issueDate);

$documentTypeCode = $doc->createElementNS($urn, 'cbc:DocumentTypeCode', 'GONDERIM_SEKLI');
$additionalDocumentReference->appendChild($documentTypeCode);

$documentType = $doc->createElementNS($urn, 'cbc:DocumentType', 'ELEKTRONIK');
$additionalDocumentReference->appendChild($documentType);


//Signature alanı eklendi
$signature = $doc->createElementNS($urna, 'cac:Signature');
$invoice->appendChild($signature);

$signatureID = $doc->createElementNS($urn, 'cbc:ID', '5750464002');
$signatureID->setAttribute('schemeID', 'VKN_TCKN');
$signature->appendChild($signatureID);

$signatoryParty = $doc->createElementNS($urna, 'cac:SignatoryParty');
$signature->appendChild($signatoryParty);

$partyIdentification = $doc->createElementNS($urna, 'cac:PartyIdentification');
$signatoryParty->appendChild($partyIdentification);

$partyID = $doc->createElementNS($urn, 'cbc:ID', '5750464002');
$partyID->setAttribute('schemeID', 'VKN');
$partyIdentification->appendChild($partyID);

$postalAddress = $doc->createElementNS($urna, 'cac:PostalAddress');
$signatoryParty->appendChild($postalAddress);

$room = $doc->createElementNS($urn, 'cbc:Room', '201-204');
$postalAddress->appendChild($room);

$streetName = $doc->createElementNS($urn, 'cbc:StreetName', 'A.T.G.B. Üniversiteler Mah. 1605. Cad.');
$postalAddress->appendChild($streetName);

$buildingName = $doc->createElementNS($urn, 'cbc:BuildingName', 'Cyberpark Vakıf Binası');
$postalAddress->appendChild($buildingName);

$buildingNumber = $doc->createElementNS($urn, 'cbc:BuildingNumber', '3');
$postalAddress->appendChild($buildingNumber);

$citySubdivisionName = $doc->createElementNS($urn, 'cbc:CitySubdivisionName', 'Çankaya');
$postalAddress->appendChild($citySubdivisionName);

$cityName = $doc->createElementNS($urn, 'cbc:CityName', 'Ankara');
$postalAddress->appendChild($cityName);

$postalZone = $doc->createElementNS($urn, 'cbc:PostalZone', '06800');
$postalAddress->appendChild($postalZone);

$country = $doc->createElementNS($urna, 'cac:Country');
$postalAddress->appendChild($country);

$countryName = $doc->createElementNS($urn, 'cbc:Name', 'Türkiye');
$country->appendChild($countryName);

$digitalSignatureAttachment = $doc->createElementNS($urna, 'cac:DigitalSignatureAttachment');
$signature->appendChild($digitalSignatureAttachment);

$externalReference = $doc->createElementNS($urna, 'cac:ExternalReference');
$digitalSignatureAttachment->appendChild($externalReference);

$externalURI = $doc->createElementNS($urn, 'cbc:URI', '#Signature_abf8a880-aa37-40bb-8527-569cff5f659e');
$externalReference->appendChild($externalURI);





// AccountingSupplierParty elemanını oluşturuldu ve eklendi
$accountingSupplierParty = $doc->createElementNS($urna, 'cac:AccountingSupplierParty');
$invoice->appendChild($accountingSupplierParty);

// Party elemanını oluşturuldu ve eklendi
$party = $doc->createElementNS($urna, 'cac:Party');
$accountingSupplierParty->appendChild($party);


// PartyIdentification elemanını oluşturuldu ve eklendi
$partyIdentification = $doc->createElementNS($urna, 'cac:PartyIdentification');
$party->appendChild($partyIdentification);

// ID elemanını oluşturuldu şemaya eklendi  
$id = $doc->createElementNS($urn, 'cbc:ID', '0102056568');
$id->setAttribute('schemeID', 'VKN');
$partyIdentification->appendChild($id);

// PartyName elemanını oluşturuldu ve eklendi
$partyName = $doc->createElementNS($urna, 'cac:PartyName');
$party->appendChild($partyName);

// Name elemanını oluşturuldu ve eklendi
$name = $doc->createElementNS($urn, 'cbc:Name', 'Sahane Kitap');
$partyName->appendChild($name);

// PostalAddress elemanını oluşturuldu ve eklendi
$postalAddress = $doc->createElementNS($urna, 'cac:PostalAddress');
$party->appendChild($postalAddress);

// CitySubdivisionName elemanını oluşturuldu ve eklendi
$citySubdivisionName = $doc->createElementNS($urn, 'cbc:CitySubdivisionName', 'Çankaya');
$postalAddress->appendChild($citySubdivisionName);

// CityName elemanını oluşturuldu ve eklendi
$cityName = $doc->createElementNS($urn, 'cbc:CityName', 'Ankara');
$postalAddress->appendChild($cityName);

// Country elemanını oluşturuldu ve eklendi
$country = $doc->createElementNS($urna, 'cac:Country');
$postalAddress->appendChild($country);

// Name elemanını oluşturuldu ve eklendi
$countryName = $doc->createElementNS($urn, 'cbc:Name', 'Türkiye');
$country->appendChild($countryName);

// PartyTaxScheme elemanını oluşturuldu ve eklendi
$partyTaxScheme = $doc->createElementNS($urna, 'cac:PartyTaxScheme');
$party->appendChild($partyTaxScheme);

// TaxScheme elemanını oluşturuldu ve eklendi
$taxScheme = $doc->createElementNS($urna, 'cac:TaxScheme');
$partyTaxScheme->appendChild($taxScheme);

// Name elemanını oluşturuldu ve eklendi
$taxSchemeName = $doc->createElementNS($urn, 'cbc:Name', 'DİKİMEVİ VERGİ DAİRESİ MÜDÜRLÜĞÜ');
$taxScheme->appendChild($taxSchemeName);

// Contact elemanını oluşturuldu ve eklendi
$contact = $doc->createElementNS($urna, 'cac:Contact');
$party->appendChild($contact);

// ElectronicMail elemanını oluşturuldu ve eklendi
$electronicMail = $doc->createElementNS($urn, 'cbc:ElectronicMail', 'ozgur.ari@kolaysoft.com.tr');
$contact->appendChild($electronicMail);


// AccountingCustomerParty güncellendi
$accountingCustomerParty = $doc->createElementNS($urna, 'AccountingCustomerParty');
$party = $doc->createElementNS($urna, 'Party');
$accountingCustomerParty->appendChild($party);
$invoice->appendChild($accountingCustomerParty);


$partyIdentification = $doc->createElementNS($urn, 'PartyIdentification');
$id = $doc->createElementNS($urn, 'ID', '11111111111');
$id->setAttribute('schemeID', 'TCKN');
$partyIdentification->appendChild($id);
$party->appendChild($partyIdentification);

$postalAddress = $doc->createElementNS($urna, 'PostalAddress');
$citySubdivisionName = $doc->createElementNS($urna, 'CitySubdivisionName', 'Çankaya');
$postalAddress->appendChild($citySubdivisionName);
$cityName = $doc->createElementNS($urna, 'CityName', 'Ankara');
$postalAddress->appendChild($cityName);
$country = $doc->createElementNS($urna, 'Country');
$name = $doc->createElementNS($urna, 'Name', 'Türkiye');
$country->appendChild($name);
$postalAddress->appendChild($country);
$party->appendChild($postalAddress);

$partyTaxScheme = $doc->createElementNS($urn, 'PartyTaxScheme');
$taxScheme = $doc->createElementNS($urn, 'TaxScheme');
$name = $doc->createElementNS($urn, 'Name', '');
$taxScheme->appendChild($name);
$partyTaxScheme->appendChild($taxScheme);
$party->appendChild($partyTaxScheme);

$person = $doc->createElementNS($urna, 'Person');
$firstName = $doc->createElementNS($urna, 'FirstName', 'test');
$person->appendChild($firstName);
$familyName = $doc->createElementNS($urna, 'FamilyName', 'test');
$person->appendChild($familyName);
$party->appendChild($person);

// AllowanceCharge eklendi 
$AllowanceCharge = $doc->createElementNS($urna, 'cac:AllowanceCharge');
$invoice->appendChild($AllowanceCharge);

$ChargeIndicator = $doc->createElementNS($urn, 'cbc:ChargeIndicator', 'false');
$AllowanceCharge->appendChild($ChargeIndicator);

$id = $doc->createElementNS($urn, 'Amount', '0');
$id->setAttribute('currencyID', 'TRY');
$AllowanceCharge->appendChild($id);


// TaxTotal güncellendi
$TaxTotal = $doc->createElementNS($urna, 'cac:TaxTotal');
$invoice->appendChild($TaxTotal);

$TaxAmount = $doc->createElementNS($urn, 'cbc:TaxAmount', '0.18');
$TaxAmount->setAttribute('currencyID', 'TRY');
$TaxTotal->appendChild($TaxAmount);

$TaxSubtotal = $doc->createElementNS($urna, 'cac:TaxSubtotal');
$TaxTotal->appendChild($TaxSubtotal);

$TaxableAmount = $doc->createElementNS($urn, 'cbc:TaxableAmount', '1');
$TaxableAmount->setAttribute('currencyID', 'TRY');
$TaxSubtotal->appendChild($TaxableAmount);

$TaxAmount = $doc->createElementNS($urn, 'cbc:TaxAmount', '0.18');
$TaxAmount->setAttribute('currencyID', 'TRY');
$TaxSubtotal->appendChild($TaxAmount);

$Percent = $doc->createElementNS($urn, 'cbc:Percent', '18');
$TaxSubtotal->appendChild($Percent);

$TaxCategory = $doc->createElementNS($urna, 'cac:TaxCategory');
$TaxSubtotal->appendChild($TaxCategory);

$TaxScheme = $doc->createElementNS($urna, 'cac:TaxScheme');
$TaxCategory->appendChild($TaxScheme);

$Name = $doc->createElementNS($urn, 'cbc:Name', 'GERÇEK USULDE KATMA DEĞER VERGİSİ');
$TaxScheme->appendChild($Name);

$TaxTypeCode = $doc->createElementNS($urn, 'cbc:TaxTypeCode', '0015');
$TaxScheme->appendChild($TaxTypeCode);


//LegalMonetaryTotal güncellendi
$LegalMonetaryTotal = $doc->createElementNS($urna, 'cac:LegalMonetaryTotal');
$invoice->appendChild($LegalMonetaryTotal);

$LineExtensionAmount = $doc->createElementNS($urn, 'cbc:LineExtensionAmount');
$LineExtensionAmount->setAttribute('currencyID', 'TRY');
$LineExtensionAmount->nodeValue = '1.00';
$LegalMonetaryTotal->appendChild($LineExtensionAmount);

$TaxExclusiveAmount = $doc->createElementNS($urn, 'cbc:TaxExclusiveAmount');
$TaxExclusiveAmount->setAttribute('currencyID', 'TRY');
$TaxExclusiveAmount->nodeValue = '1.00';
$LegalMonetaryTotal->appendChild($TaxExclusiveAmount);

$TaxInclusiveAmount = $doc->createElementNS($urn, 'cbc:TaxInclusiveAmount');
$TaxInclusiveAmount->setAttribute('currencyID', 'TRY');
$TaxInclusiveAmount->nodeValue = '1.18';
$LegalMonetaryTotal->appendChild($TaxInclusiveAmount);

$AllowanceTotalAmount = $doc->createElementNS($urn, 'cbc:AllowanceTotalAmount');
$AllowanceTotalAmount->setAttribute('currencyID', 'TRY');
$AllowanceTotalAmount->nodeValue = '0.00';
$LegalMonetaryTotal->appendChild($AllowanceTotalAmount);

$PayableAmount = $doc->createElementNS($urn, 'cbc:PayableAmount');
$PayableAmount->setAttribute('currencyID', 'TRY');
$PayableAmount->nodeValue = '1.18';
$LegalMonetaryTotal->appendChild($PayableAmount);



// InvoiceLine ekle
$InvoiceLine = $doc->createElementNS($urna, 'cac:InvoiceLine');
$invoice->appendChild($InvoiceLine);

// ID ekle
$ID = $doc->createElementNS($urn, 'cbc:ID', '1');
$InvoiceLine->appendChild($ID);

// InvoicedQuantity ekle
$InvoicedQuantity = $doc->createElementNS($urn, 'cbc:InvoicedQuantity', '1');
$InvoicedQuantity->setAttribute('unitCode', 'C62');
$InvoiceLine->appendChild($InvoicedQuantity);

// LineExtensionAmount ekle
$LineExtensionAmount = $doc->createElementNS($urn, 'cbc:LineExtensionAmount', '1');
$LineExtensionAmount->setAttribute('currencyID', 'TRY');
$InvoiceLine->appendChild($LineExtensionAmount);

// TaxTotal ekle
$TaxTotal = $doc->createElementNS($urna, 'cac:TaxTotal');
$InvoiceLine->appendChild($TaxTotal);

// TaxAmount ekle
$TaxAmount = $doc->createElementNS($urn, 'cbc:TaxAmount', '0.18');
$TaxAmount->setAttribute('currencyID', 'TRY');
$TaxTotal->appendChild($TaxAmount);

// TaxSubtotal ekle
$TaxSubtotal = $doc->createElementNS($urna, 'cac:TaxSubtotal');
$TaxTotal->appendChild($TaxSubtotal);

// TaxableAmount ekle
$TaxableAmount = $doc->createElementNS($urn, 'cbc:TaxableAmount', '1');
$TaxableAmount->setAttribute('currencyID', 'TRY');
$TaxSubtotal->appendChild($TaxableAmount);

// TaxAmount ekle
$TaxAmount2 = $doc->createElementNS($urn, 'cbc:TaxAmount', '0.18');
$TaxAmount2->setAttribute('currencyID', 'TRY');
$TaxSubtotal->appendChild($TaxAmount2);

// Percent ekle
$Percent = $doc->createElementNS($urn, 'cbc:Percent', '18');
$TaxSubtotal->appendChild($Percent);



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
        $document->xmlContent = file_get_contents('faturanew.xml');
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

            echo 'İşlem kodu: ' . $res->code . '<br>' ;
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


earsiv_fatura();
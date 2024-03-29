<?php

// Ubl 2.1 formatında xml fatura oluşturur, fatura üzerinde kod üzerinde değişiklikler yaparak düzenlenebilir.
function ublInvoiceCreate()
{ 
    require "config.php";

    
    // Fatura nesnesi oluşturma
    $doc = new DOMDocument("1.0", "UTF-8");
    $doc->formatOutput = true;

    $urn =
        "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2";
    $urna =
        "urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2";

    // Fatura kök düğümü oluşturma
    $invoice = $doc->createElementNS(
        "urn:oasis:names:specification:ubl:schema:xsd:Invoice-2",
        "Invoice"
    );
    $invoice->setAttributeNS(
        "http://www.w3.org/2000/xmlns/",
        "xmlns:cbc",
        "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
    );
    $invoice->setAttributeNS(
        "http://www.w3.org/2000/xmlns/",
        "xmlns:cac",
        "urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
    );
    $invoice->setAttributeNS(
        "http://www.w3.org/2000/xmlns/",
        "xmlns:ext",
        "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
    );

    $doc->appendChild($invoice);

    // UBLNamespaces nesnesi oluşturma ve namespace'leri ekleyerek kök düğüme ekleme
    $UBLExtensions = $doc->createElementNS(
        "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2",
        "UBLExtensions"
    );
    $invoice->appendChild($UBLExtensions);

    $UBLExtension = $doc->createElementNS(
        "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2",
        "UBLExtension"
    );
    $UBLExtensions->appendChild($UBLExtension);

    $ExtensionContent = $doc->createElementNS(
        "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2",
        "ext:ExtensionContent"
    );
    $UBLExtension->appendChild($ExtensionContent);

    $auto_generated_wildcard = $doc->createElement("auto-generated-wildcard");
    $ExtensionContent->appendChild($auto_generated_wildcard);

    $UBLVersionID = $doc->createElementNS($urn, "cbc:UBLVersionID", $UBLVersion_ID);
    $invoice->appendChild($UBLVersionID);

    $CustomizationID = $doc->createElementNS(
        $urn,
        "cbc:CustomizationID",
        $Customization_ID 
    );
    $invoice->appendChild($CustomizationID);

    // ProfileID
    $ProfileID = $doc->createElementNS($urn, "cbc:ProfileID", $Profile_ID);
    $invoice->appendChild($ProfileID);

    // ID alanı değişecek - generate -yıl+ay+gun+random
    $ID = $doc->createElementNS($urn, "cbc:ID", $Fatura_ID);
    $invoice->appendChild($ID);

    // CopyIndicator
    $CopyIndicator = $doc->createElementNS($urn, "cbc:CopyIndicator", $Copy_Indicator);
    $invoice->appendChild($CopyIndicator);

    // UUID eklendi
    $UUID = $doc->createElementNS(
        $urn,
        "cbc:UUID",
        $UUIDnum
    );
    $invoice->appendChild($UUID);

    // IssueDate
    $IssueDate = $doc->createElementNS($urn, "cbc:IssueDate", $Issue_Date);
    $invoice->appendChild($IssueDate);

    // IssueTime eklendi
    $IssueTime = $doc->createElementNS($urn, "cbc:IssueTime", $Issue_Time);
    $invoice->appendChild($IssueTime);

    // InvoiceTypeCode
    $InvoiceTypeCode = $doc->createElementNS(
        $urn,
        "cbc:InvoiceTypeCode",
        $InvoiceType_Code
    );
    $invoice->appendChild($InvoiceTypeCode);

    // Note eklendi
    $Note = $doc->createElementNS(
        $urn,
        "cbc:Note",
        $Note_Yaziyla
    );
    $invoice->appendChild($Note);

    // DocumentCurrencyCode
    $DocumentCurrencyCode = $doc->createElementNS(
        $urn,
        "cbc:DocumentCurrencyCode",
        $DocumentCurrenc_Code
    );
    $invoice->appendChild($DocumentCurrencyCode);

    // LineCountNumeric eklendi
    $LineCountNumeric = $doc->createElementNS(
        $urn,
        "cbc:LineCountNumeric",
        $LineCountNumeric
    );
    $invoice->appendChild($LineCountNumeric);

    // AdditionalDocumentReference elemanını oluşturuldu ve eklendi
    $additionalDocRef = $doc->createElementNS(
        $urna,
        "cac:AdditionalDocumentReference"
    );
    $invoice->appendChild($additionalDocRef);

    $id = $doc->createElementNS(
        $urn,
        "cbc:ID",
        $AdditionalDocumentReference_ID
    );
    $additionalDocRef->appendChild($id);

    $issueDate = $doc->createElementNS($urn, "cbc:IssueDate", $AdditionalDocumentReference_IssueDate);
    $additionalDocRef->appendChild($issueDate);

    $docType = $doc->createElementNS($urn, "cbc:DocumentType", "XSLT");
    $additionalDocRef->appendChild($docType);

    $invoice->appendChild($additionalDocRef);

    // additionalDocumentReference elemanını oluşturuldu ve eklendi
    $additionalDocumentReference = $doc->createElementNS(
        $urna,
        "cac:AdditionalDocumentReference"
    );
    $invoice->appendChild($additionalDocumentReference);

    $ID = $doc->createElementNS(
        $urn,
        "cbc:ID",
        $AdditionalDocumentReference_ID2
    );
    $additionalDocumentReference->appendChild($ID);

    $issueDate = $doc->createElementNS($urn, "cbc:IssueDate", $AdditionalDocumentReference_IssueDate);
    $additionalDocumentReference->appendChild($issueDate);

    $documentTypeCode = $doc->createElementNS(
        $urn,
        "cbc:DocumentTypeCode",
        $AdditionalDocumentReference_DocumentTypeCode
    );
    $additionalDocumentReference->appendChild($documentTypeCode);

    $documentType = $doc->createElementNS(
        $urn,
        "cbc:DocumentType",
        $AdditionalDocumentReference_DocumentType
    );
    $additionalDocumentReference->appendChild($documentType);

    //Signature alanı eklendi
    $signature = $doc->createElementNS($urna, "cac:Signature");
    $invoice->appendChild($signature);

    $signatureID = $doc->createElementNS($urn, "cbc:ID", $Signature_ID_VKN_TCKN);
    $signatureID->setAttribute("schemeID", "VKN_TCKN");
    $signature->appendChild($signatureID);

    $signatoryParty = $doc->createElementNS($urna, "cac:SignatoryParty");
    $signature->appendChild($signatoryParty);

    $partyIdentification = $doc->createElementNS(
        $urna,
        "cac:PartyIdentification"
    );
    $signatoryParty->appendChild($partyIdentification);

    $partyID = $doc->createElementNS($urn, "cbc:ID", $SignatoryParty_PartyIdentification_ID);
    $partyID->setAttribute("schemeID", "VKN");
    $partyIdentification->appendChild($partyID);

    $postalAddress = $doc->createElementNS($urna, "cac:PostalAddress");
    $signatoryParty->appendChild($postalAddress);

    $room = $doc->createElementNS($urn, "cbc:Room", $SignatoryParty_PostalAddress_Room );
    $postalAddress->appendChild($room);

    $streetName = $doc->createElementNS(
        $urn,
        "cbc:StreetName",
        $SignatoryParty_StreetName
    );
    $postalAddress->appendChild($streetName);

    $buildingName = $doc->createElementNS(
        $urn,
        "cbc:BuildingName",
        $SignatoryParty_BuildingName
    );
    $postalAddress->appendChild($buildingName);

    $buildingNumber = $doc->createElementNS($urn, "cbc:BuildingNumber", $SignatoryParty_BuildingNumber);
    $postalAddress->appendChild($buildingNumber);

    $citySubdivisionName = $doc->createElementNS(
        $urn,
        "cbc:CitySubdivisionName",
        $SignatoryParty_CitySubdivisionName
    );
    $postalAddress->appendChild($citySubdivisionName);

    $cityName = $doc->createElementNS($urn, "cbc:CityName", $SignatoryParty_CityName);
    $postalAddress->appendChild($cityName);

    $postalZone = $doc->createElementNS($urn, "cbc:PostalZone", $SignatoryParty_PostalZone);
    $postalAddress->appendChild($postalZone);

    $country = $doc->createElementNS($urna, "cac:Country");
    $postalAddress->appendChild($country);

    $countryName = $doc->createElementNS($urn, "cbc:Name", $SignatoryParty_Country_Name);
    $country->appendChild($countryName);

    $digitalSignatureAttachment = $doc->createElementNS(
        $urna,
        "cac:DigitalSignatureAttachment"
    );
    $signature->appendChild($digitalSignatureAttachment);

    $externalReference = $doc->createElementNS($urna, "cac:ExternalReference");
    $digitalSignatureAttachment->appendChild($externalReference);

    $externalURI = $doc->createElementNS(
        $urn,
        "cbc:URI",
        $Signature_ExternalReference_URI
    );
    $externalReference->appendChild($externalURI);

    // AccountingSupplierParty elemanını oluşturuldu ve eklendi
    $accountingSupplierParty = $doc->createElementNS(
        $urna,
        "cac:AccountingSupplierParty"
    );
    $invoice->appendChild($accountingSupplierParty);

    // Party elemanını oluşturuldu ve eklendi
    $party = $doc->createElementNS($urna, "cac:Party");
    $accountingSupplierParty->appendChild($party);

    // PartyIdentification elemanını oluşturuldu ve eklendi
    $partyIdentification = $doc->createElementNS(
        $urna,
        "cac:PartyIdentification"
    );
    $party->appendChild($partyIdentification);

    // ID elemanını oluşturuldu şemaya eklendi
    $id = $doc->createElementNS($urn, "cbc:ID", $AccountingSupplierParty_PartyIdentification_ID);
    $id->setAttribute("schemeID", "VKN");
    $partyIdentification->appendChild($id);

    // PartyName elemanını oluşturuldu ve eklendi
    $partyName = $doc->createElementNS($urna, "cac:PartyName");
    $party->appendChild($partyName);

    // Name elemanını oluşturuldu ve eklendi
    $name = $doc->createElementNS($urn, "cbc:Name", $AccountingSupplierParty_PartyName);
    $partyName->appendChild($name);

    // PostalAddress elemanını oluşturuldu ve eklendi
    $postalAddress = $doc->createElementNS($urna, "cac:PostalAddress");
    $party->appendChild($postalAddress);

    // CitySubdivisionName elemanını oluşturuldu ve eklendi
    $citySubdivisionName = $doc->createElementNS(
        $urn,
        "cbc:CitySubdivisionName",
        $AccountingSupplierParty_PostalAddress_CitySubdivisionName
    );
    $postalAddress->appendChild($citySubdivisionName);

    // CityName elemanını oluşturuldu ve eklendi
    $cityName = $doc->createElementNS($urn, "cbc:CityName", $AccountingSupplierParty_PostalAddress_CityName);
    $postalAddress->appendChild($cityName);

    // Country elemanını oluşturuldu ve eklendi
    $country = $doc->createElementNS($urna, "cac:Country");
    $postalAddress->appendChild($country);

    // Name elemanını oluşturuldu ve eklendi
    $countryName = $doc->createElementNS($urn, "cbc:Name", $AccountingSupplierParty_PostalAddress_Country);
    $country->appendChild($countryName);

    // PartyTaxScheme elemanını oluşturuldu ve eklendi
    $partyTaxScheme = $doc->createElementNS($urna, "cac:PartyTaxScheme");
    $party->appendChild($partyTaxScheme);

    // TaxScheme elemanını oluşturuldu ve eklendi
    $taxScheme = $doc->createElementNS($urna, "cac:TaxScheme");
    $partyTaxScheme->appendChild($taxScheme);

    // Name elemanını oluşturuldu ve eklendi
    $taxSchemeName = $doc->createElementNS(
        $urn,
        "cbc:Name",
        $AccountingSupplierParty_PartyTaxScheme_Name
    );
    $taxScheme->appendChild($taxSchemeName);

    // Contact elemanını oluşturuldu ve eklendi
    $contact = $doc->createElementNS($urna, "cac:Contact");
    $party->appendChild($contact);

    // ElectronicMail elemanını oluşturuldu ve eklendi
    $electronicMail = $doc->createElementNS(
        $urn,
        "cbc:ElectronicMail",
        $AccountingSupplierParty_Contact_ElectronicMail
    );
    $contact->appendChild($electronicMail);

    // AccountingCustomerParty hatalaları düzeltildi
    $accountingCustomerParty = $doc->createElement(
        "cac:AccountingCustomerParty"
    );
    $invoice->appendChild($accountingCustomerParty);

    $party = $doc->createElement("cac:Party");
    $accountingCustomerParty->appendChild($party);

    $partyIdentification = $doc->createElement("cac:PartyIdentification");
    $party->appendChild($partyIdentification);

    $id = $doc->createElement("cbc:ID", $AccountingCustomerParty_PartyIdentificatio_TCKN);
    $id->setAttribute("schemeID", "TCKN");
    $partyIdentification->appendChild($id);

    $postalAddress = $doc->createElement("cac:PostalAddress");
    $party->appendChild($postalAddress);

    $citySubdivisionName = $doc->createElement(
        "cbc:CitySubdivisionName",
        $AccountingCustomerParty_PostalAddress_CitySubdivisionName
    );
    $postalAddress->appendChild($citySubdivisionName);

    $cityName = $doc->createElement("cbc:CityName", $AccountingCustomerParty_PostalAddress_CityName);
    $postalAddress->appendChild($cityName);

    $country = $doc->createElement("cac:Country");
    $postalAddress->appendChild($country);

    $countryName = $doc->createElement("cbc:Name", $AccountingCustomerParty_PostalAddress_Country);
    $country->appendChild($countryName);

    $partyTaxScheme = $doc->createElement("cac:PartyTaxScheme");
    $party->appendChild($partyTaxScheme);

    $taxScheme = $doc->createElement("cac:TaxScheme");
    $partyTaxScheme->appendChild($taxScheme);

    $taxSchemeName = $doc->createElement("cbc:Name", "");
    $taxScheme->appendChild($taxSchemeName);

    $person = $doc->createElement("cac:Person");
    $party->appendChild($person);

    $firstName = $doc->createElement("cbc:FirstName", $AccountingCustomerParty_Customer_FirstName);
    $person->appendChild($firstName);

    $familyName = $doc->createElement("cbc:FamilyName", $AccountingCustomerParty_Customer_LastName);
    $person->appendChild($familyName);

    // AllowanceCharge eklendi
    $AllowanceCharge = $doc->createElementNS($urna, "cac:AllowanceCharge");
    $invoice->appendChild($AllowanceCharge);

    $ChargeIndicator = $doc->createElementNS(
        $urn,
        "cbc:ChargeIndicator",
        $AllowanceCharge_ChargeIndicator
    );
    $AllowanceCharge->appendChild($ChargeIndicator);

    $id = $doc->createElementNS($urn, "Amount", $AllowanceCharge_Amount);
    $id->setAttribute("currencyID", "TRY");
    $AllowanceCharge->appendChild($id);

    // TaxTotal güncellendi
    $TaxTotal = $doc->createElementNS($urna, "cac:TaxTotal");
    $invoice->appendChild($TaxTotal);

    $TaxAmount = $doc->createElementNS($urn, "cbc:TaxAmount", $TaxTotal_TaxAmount);
    $TaxAmount->setAttribute("currencyID", "TRY");
    $TaxTotal->appendChild($TaxAmount);

    $TaxSubtotal = $doc->createElementNS($urna, "cac:TaxSubtotal");
    $TaxTotal->appendChild($TaxSubtotal);

    $TaxableAmount = $doc->createElementNS($urn, "cbc:TaxableAmount", $TaxTotal_TaxSubtotal_TaxableAmount);
    $TaxableAmount->setAttribute("currencyID", "TRY");
    $TaxSubtotal->appendChild($TaxableAmount);

    $TaxAmount = $doc->createElementNS($urn, "cbc:TaxAmount", $TaxTotal_TaxSubtotal_TaxAmount);
    $TaxAmount->setAttribute("currencyID", "TRY");
    $TaxSubtotal->appendChild($TaxAmount);

    $Percent = $doc->createElementNS($urn, "cbc:Percent", $TaxTotal_TaxSubtotal_Percent);
    $TaxSubtotal->appendChild($Percent);

    $TaxCategory = $doc->createElementNS($urna, "cac:TaxCategory");
    $TaxSubtotal->appendChild($TaxCategory);

    $TaxScheme = $doc->createElementNS($urna, "cac:TaxScheme");
    $TaxCategory->appendChild($TaxScheme);

    $Name = $doc->createElementNS(
        $urn,
        "cbc:Name",
        $TaxTotal_TaxScheme_Name
    );
    $TaxScheme->appendChild($Name);

    $TaxTypeCode = $doc->createElementNS($urn, "cbc:TaxTypeCode", $TaxTotal_TaxTypeCode);
    $TaxScheme->appendChild($TaxTypeCode);

    //LegalMonetaryTotal güncellendi
    $LegalMonetaryTotal = $doc->createElementNS(
        $urna,
        "cac:LegalMonetaryTotal"
    );
    $invoice->appendChild($LegalMonetaryTotal);

    $LineExtensionAmount = $doc->createElementNS(
        $urn,
        "cbc:LineExtensionAmount"
    );
    $LineExtensionAmount->setAttribute("currencyID", "TRY");
    $LineExtensionAmount->nodeValue = $LegalMonetaryTotal_LineExtensionAmount;
    $LegalMonetaryTotal->appendChild($LineExtensionAmount);

    $TaxExclusiveAmount = $doc->createElementNS($urn, "cbc:TaxExclusiveAmount");
    $TaxExclusiveAmount->setAttribute("currencyID", "TRY");
    $TaxExclusiveAmount->nodeValue = $LegalMonetaryTotal_TaxExclusiveAmount;
    $LegalMonetaryTotal->appendChild($TaxExclusiveAmount);

    $TaxInclusiveAmount = $doc->createElementNS($urn, "cbc:TaxInclusiveAmount");
    $TaxInclusiveAmount->setAttribute("currencyID", "TRY");
    $TaxInclusiveAmount->nodeValue = $LegalMonetaryTotal_TaxInclusiveAmount;
    $LegalMonetaryTotal->appendChild($TaxInclusiveAmount);

    $AllowanceTotalAmount = $doc->createElementNS(
        $urn,
        "cbc:AllowanceTotalAmount"
    );
    $AllowanceTotalAmount->setAttribute("currencyID", "TRY");
    $AllowanceTotalAmount->nodeValue = $LegalMonetaryTotal_AllowanceTotalAmount;
    $LegalMonetaryTotal->appendChild($AllowanceTotalAmount);

    $PayableAmount = $doc->createElementNS($urn, "cbc:PayableAmount");
    $PayableAmount->setAttribute("currencyID", "TRY");
    $PayableAmount->nodeValue = $LegalMonetaryTotal_PayableAmount;
    $LegalMonetaryTotal->appendChild($PayableAmount);

    $InvoiceLine = $doc->createElementNS($urna, "cac:InvoiceLine");
    $invoice->appendChild($InvoiceLine);

    $ID = $doc->createElementNS($urn, "cbc:ID", $InvoiceLine_ID);
    $InvoiceLine->appendChild($ID);

    $InvoicedQuantity = $doc->createElementNS(
        $urn,
        "cbc:InvoicedQuantity",
        $InvoiceLine_InvoicedQuantity
    );
    $InvoicedQuantity->setAttribute("unitCode", "C62");
    $InvoiceLine->appendChild($InvoicedQuantity);

    $LineExtensionAmount = $doc->createElementNS(
        $urn,
        "cbc:LineExtensionAmount",
        $InvoiceLine_LineExtensionAmount
    );
    $LineExtensionAmount->setAttribute("currencyID", "TRY");
    $InvoiceLine->appendChild($LineExtensionAmount);

    $TaxTotal = $doc->createElementNS($urna, "cac:TaxTotal");
    $InvoiceLine->appendChild($TaxTotal);

    $TaxAmount = $doc->createElementNS($urn, "cbc:TaxAmount", $InvoiceLine_TaxTotal_TaxAmount);
    $TaxAmount->setAttribute("currencyID", "TRY");
    $TaxTotal->appendChild($TaxAmount);

    $TaxSubtotal = $doc->createElementNS($urna, "cac:TaxSubtotal");
    $TaxTotal->appendChild($TaxSubtotal);

    $TaxableAmount = $doc->createElementNS($urn, "cbc:TaxableAmount", $InvoiceLine_TaxSubtotal_TaxableAmount);
    $TaxableAmount->setAttribute("currencyID", "TRY");
    $TaxSubtotal->appendChild($TaxableAmount);

    $TaxAmount = $doc->createElementNS($urn, "cbc:TaxAmount", $InvoiceLine_TaxSubtotal_TaxAmount);
    $TaxAmount->setAttribute("currencyID", "TRY");
    $TaxSubtotal->appendChild($TaxAmount);

    $Percent = $doc->createElementNS($urn, "cbc:Percent", $InvoiceLine_TaxSubtotal_Percent);
    $TaxSubtotal->appendChild($Percent);

    $TaxCategory = $doc->createElementNS($urna, "cac:TaxCategory");
    $TaxSubtotal->appendChild($TaxCategory);

    $TaxScheme = $doc->createElementNS($urna, "cac:TaxScheme");
    $TaxCategory->appendChild($TaxScheme);

    $Name = $doc->createElementNS(
        $urn,
        "cbc:Name",
        $InvoiceLine_TaxCategory_Name
    );
    $TaxScheme->appendChild($Name);

    $TaxTypeCode = $doc->createElementNS($urn, "cbc:TaxTypeCode", $InvoiceLine_TaxTypeCode );
    $TaxScheme->appendChild($TaxTypeCode);

    $Item = $doc->createElementNS($urna, "cac:Item");
    $InvoiceLine->appendChild($Item);

    $Name = $doc->createElementNS($urn, "cbc:Name", $InvoiceLine_Item_Name);
    $Item->appendChild($Name);

    $Price = $doc->createElementNS($urna, "cac:Price");
    $InvoiceLine->appendChild($Price);

    $PriceAmount = $doc->createElementNS($urn, "cbc:PriceAmount", $InvoiceLine_Price );
    $PriceAmount->setAttribute("currencyID", "TRY");
    $Price->appendChild($PriceAmount);

    // convert the XML object to string
    //$xmlString = $doc->saveXML();

    // echo($xmlString);

    $file_path = "e_arsiv_invoice.xml";
    $file = fopen($file_path, "w");

    $xml_content = $doc->saveXML();

    fwrite($file, $xml_content);
    
    
    try {
        // Kullanıcı adı ve şifre
        $username = "admin_002874";
        $password = ")xrd9!iX";

        // SOAP bağlantısı kurulur
        $client = new SoapClient(
            "https://servis.kolayentegrasyon.net/EArchiveInvoiceService/EArchiveInvoiceWS?wsdl",
            [
                "soap_version" => SOAP_1_2,
                "stream_context" => stream_context_create([
                    "http" => [
                        "header" => "Username: $username\r\nPassword: $password\r\n",
                    ],
                ]),
            ]
        );

        // Fatura bilgileri oluşturulur
        // Fatura gönderme işlemi gerçekleştirilir
        
        $xml = simplexml_load_string($xml_content);

        $destinationUrn = $destinationUrnConfig;
        $documentDate = $documentDateConfig;
        


        $documentId = $Fatura_ID;
    
        echo "Fatura ID: " . $documentId;

        echo "<br/>";
        echo "<br/>";

        $documentUUID = (string)$xml->children('cbc', true)->UUID;

        echo "documentUUID: " . $documentUUID . "\n";



        $inputDocument = new InputDocument($xml_content, $destinationUrn, $documentDate, $documentUUID, $sourceUrn, $localId, $documentId);

        //$response = $client->sendInvoice([$inputDocument]);


        
        // Yanıt işlenir
        foreach ($response as $res) {

            echo "İşlem kodu: " . $res->code . "<br>";
            echo "Açıklama: " . $res->explanation . "<br>";


            if (isset($res->cause)) {
                echo "Hata sebebi: " . $res->cause . "<br>";
            }

            echo "<br>";

            if ($res->code == "200") {
                $invoiceNumber = $res->invoiceNumber;
                $ettn = $res->ettn;
            
                echo "Fatura başarıyla oluşturuldu. Fatura Numarası: " . $invoiceNumber . " ETTN: " . $ettn . "<br>";
            
            }


        }
    } catch (\Exception $e) {
        echo "Şuan işleminiz gerçekleştirilemiyor, lütfen daha sonra tekrar deneyiniz.";
    }


}

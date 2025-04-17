---
title: Namirial Service
description: Namirial Service
extends: _layouts.documentation
section: content
---

# namirial_service

This is a PHP class called NamirialService in the namespace Modules\Notify\Services, that provides methods to interact with the Namirial API. It has the following public methods:
    
setRecipientGivenName($name): sets the given name of the recipient of a document to be signed.

setRecipientEmail($email): sets the email of the recipient of a document to be signed.

setRecipientPhoneNumber($phone_number): sets the phone number of the recipient of a document to be signed.

setRecipientSurname($surname): sets the surname of the recipient of a document to be signed.

systemVersion(): retrieves the system version of the Namirial API.

fileUpload($file_path): uploads a file to the Namirial API.

filePrepare(): prepares a file for sending as an envelope to be signed.

envelopeSend(): sends an envelope to the recipient for signing.

envelopeFind(?array $custom_params = []): make an HTTP POST request to the "/envelope/find" endpoint to get information about already completed envelopes, using the parameters specified in the optional $custom_params parameter. If $custom_params is not supplied, the default parameters are used. The method returns the calling object (self).

envelopeInformations(): make an HTTP GET request to the "/envelope/{last_envelope_id}" endpoint, where {last_envelope_id} represents the ID of the last envelope processed by the envelopeFind() method, to get information about that envelope. The method returns the calling object (self).

envelopeFiles(): make a GET type HTTP request to the "/envelope/{last_envelope_id}/files" endpoint, where {last_envelope_id} represents the ID of the last envelope processed by the envelopeFind() method, to get the files associated with the envelope. The method stores the ID of the last file (if any) in the $last_envelope_file_id property of the calling object (self), and returns the latter.

downloadDocument(): make a GET-type HTTP request to the "/file/{last_envelope_file_id}" endpoint, where {last_envelope_file_id} represents the ID of the last file associated with the envelope processed by the envelopeFiles() method. The method returns the calling object (self). If the $last_envelope_file_id property has not been set, an exception of type Exception is thrown.

The class also has private methods for making HTTP requests to the API, as well as private properties for storing the API credentials, the response from the API, and other information related to the last file or envelope sent.
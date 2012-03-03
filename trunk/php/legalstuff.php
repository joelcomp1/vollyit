<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	
		require_once('auth.php');
		if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
		{
				
				include "header-org.php";
				include "navigation.php";
		}
		else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
		{
				include 'header-vol.php';
				include 'navigation-vol.php';
		}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php 	
		if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
		{
			echo $_SESSION['ORG_NAME'];
		}
		else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
		{
			echo $_SESSION['SESS_MEMBER_ID'];
		}
	
	?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../form.css" type="text/css" />
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<br>
<div class="clear"></div>
<h3>
Terms of Use & Privacy Policy
</h3>
<div class="clear"></div>
<br>
<br>
<ul id="menu" class="menu">
			<li class="active"><a href="#description">Terms of Use</a></li>
			<li><a href="#usage">Privacy Policy</a></li>
		</ul>


		<div id="description" class="content">
				<h2 style="float:left;">Terms of Use</h2>
				<div class="clear"></div>
				<br>
<p>
Please Read Carefully Before Using Volly.It:
</p>
	<div class="clear"></div>
				<br><p>
Volly.It maintains this site is to be used as a service, as well as for information and communication purposes. This webpage contains the Terms of Use governing your access to and use of the Volly.It. If you do not accept these Terms of Use or you do not meet or comply with their provisions, you may not use the website
</p>
	<div class="clear"></div>
				<br><p>
<ol type="A" style="margin: 0 0 0 50px;">
<li>
<b>TERMS APPLICABLE TO ALL USERS</b>
<ol style="margin: 0 0 0 50px;">
<li>
<b>Overview</b></li>
YOUR USE OF THIS WEBSITE IS EXPRESSLY CONDITIONED UPON YOUR ACCEPTING AND AGREEING TO THESE TERMS OF USE.
</p>
<div class="clear"></div><br>
<p>
For users who are not registered with Volly.It, your use of the Website will be deemed to be acceptance of the Terms of Use. 
</p>
<div class="clear"></div><br>
<p>
For users who are registered with Volly.It, your use of the Website shall be subject to (i) certain designated terms (see Section B below) in addition to those terms applicable to all users and (ii) shall be further conditioned on your [clicking the "I AGREE TO THE TERMS OF USE" button or completing registration].
</p>
<div class="clear"></div><br>
<p>
Permitted Uses. The Customer may use Volly.It services for the following purposes (the "Permitted Uses"): 
</p>
<div class="clear"></div><br>
<p>
<ol type="a" style="margin: 0 0 0 50px;">
<li>
To organize and communicate with volunteers to participate in one or more Events in associate with the established organization.
</li>
</ol>
</p>
<div class="clear"></div><br>
<p>
IF THESE TERMS OF USE ARE NOT COMPLETELY ACCEPTABLE TO YOU, YOU MUST IMMEDIATELY TERMINATE YOUR USE OF VOLLY.IT.
</p>
<div class="clear"></div><br>
<li>
<b>Changes To Terms</b></li><p>
Volly.It may, at any time, for any reason and without notice, make changes to (i) this Website, including its look, feel, format, and content, as well as (ii) the products and/or services as described in this Website. Any modifications will take effect when posted to the Website. Therefore, each time you access the Website, you need to review the Terms of Use upon which access and use of this Website is conditioned. By your continuing use of the Website after changes are posted, you will be deemed to have accepted such changes.
</p>
<div class="clear"></div><br>
<li>
<b>Jurisdiction</b></li><p>
Volly.It is directed to those individuals and entities located in the United States. It is not directed to any person or entity in any jurisdiction where (by reason of nationality, residence, citizenship or otherwise) the publication or availability of the Website and its content, including its services, are unavailable or otherwise contrary to local laws or regulations. If this applies to you, you are not authorized to access or use any of the information on this Website. Volly.It makes no representation that the information, opinions, advice or other content on the Website (collectively, "Content") is appropriate or that its products and services are available outside of the United States. Those who choose to access this Website from other locations do so at their own risk and are responsible for compliance with applicable local laws.
</p>
<div class="clear"></div><br>
<li>
<b>Scope of Use and User E-Mail</b></li><p>
You are only authorized to view, use, copy for your records and download small portions of the Content (including without limitation text, graphics, software, audio and video files and photos) of this Website for your informational, non-commercial use, provided that you leave all the copyright notices, including copyright management information, or other proprietary notices intact. 
</p>
<div class="clear"></div><br>
<p>
You may not store, modify, reproduce, transmit, reverse engineer or distribute a significant portion of the Content on this Website, or the design or layout of the Website or individual sections of it, in any form or media. The systematic retrieval of data from the Website is also prohibited.
</p>
<div class="clear"></div><br>
<p>
E-mail submissions over the Internet may not be secure and are subject to the risk of interception by third parties. Please consider this fact before e-mailing any information. Also, please consult our <a href="legalstuff.php#usage-tab">Privacy Policy</a>. You agree not to submit or transmit any e-mails or materials through the Website that: (i) are defamatory, threatening, obscene or harassing, (ii) contain a virus, worm, Trojan horse or any other harmful component, (iii) incorporate copyrighted or other proprietary material of any third party without that party's permission or (iv) otherwise violate any applicable laws. Volly.It shall not be subject to any obligations of confidentiality regarding any information or materials that you submit online except as specified in these Terms of Use, or as set forth in any additional terms and conditions relating to specific products or services, or as otherwise specifically agreed or required by law.
</p>
<div class="clear"></div><br>
<p>
The commercial use, reproduction, transmission or distribution of any information, software or other material available through the Website without the prior written consent of Volly.It is strictly prohibited. 
</p>
<div class="clear"></div><br>
<li>
<b>Copyrights and Trademarks</b></li><p>
The materials at this site, as well as the organization and layout of this site, are copyrighted and are protected by United States and international copyright laws and treaty provisions. You may access, download and print materials on this Website solely for your personal and non-commercial use; however, any print out of this Site, or portions of the Site, must include Volly.It’s copyright notice. No right, title or interest in any of the materials contained on this Site is transferred to you as a result of accessing, downloading or printing such materials. You may not copy, modify, distribute, transmit, display, reproduce, publish, license any part of this Site; create derivative works from, link to or frame in another website, use on any other website, transfer or sell any information obtained from this Site without the prior written permission of Volly.It.
</p>
<div class="clear"></div><br>
<p>
Except as expressly provided under the "Scope of Use" Section above, you may not use, reproduce, modify, transmit, distribute, or publicly display or operate this Website without the prior written permission of Volly.It. You may not use a part of this Website on any other Website, without Volly.It’s prior written consent. 
</p>
<div class="clear"></div><br>
<p>
Volly.It respects the intellectual property rights of others and expects our Users/ users to do the same. The policy of Volly.It is to terminate the accounts of repeat copyright offenders and other users who infringe upon the intellectual property rights of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please contact us at <a href="mailto:info@volly.it">info@volly.it</a>
</p>
<div class="clear"></div><br>
<li>
<b>Links</b></li><p> 
For your convenience, we may provide links to various other Websites that may be of interest to you and for your convenience only.  However, Volly.It does not control or endorse such Websites and is not responsible for their content nor is it responsible for the accuracy or reliability of any information, data, opinions, advice, or statements contained within such Websites. Please read the terms and conditions or terms of use policies of any other company or website you may link to from our website. These Terms of Use policy applies only to Volly.It’s website and the products and services Volly.It offers.  If you decide to access any of the third party sites linked to this Website, you do so at your own risk. Volly.It reserves the right to terminate any link or linking program at any time. Volly.It disclaims all warranties, express and implied, as to the accuracy, validity, and legality or otherwise of any materials or information contained on such sites.
</p>
<div class="clear"></div><br>
<li>
<b>No Unlawful Or Prohibited Use</b></li><p> 
As a condition of your use of the Website, you warrant to Volly.It that you will not use the Website for any purpose that is unlawful or prohibited by these terms, conditions, and notices. You may not use the Website in any manner that could damage, disable, overburden, or impair the Site or interfere with any other party's use and enjoyment of the Website. You may not obtain or attempt to obtain any materials or information through any means not intentionally made available or provided for through the Site.
</p>
<div class="clear"></div><br>
<li>
<b>Spamming</b></li><p> 
Gathering email addresses from Volly.It through harvesting or automated means is prohibited.  Posting or transmitting unauthorized or unsolicited advertising, promotional materials, or any other forms of solicitation to other Users is prohibited.  Inquiries regarding a commercial relationship with Volly.It should be directed to: <a href="mailto:info@volly.it">info@volly.it</a> 
</p>
<div class="clear"></div><br>
<li>
<b>No Warranties </b></li><p> 
THE WEBSITE, AND ANY CONTENT, ARE PROVIDED TO YOU ON AN "AS IS," "AS AVAILABLE" BASIS WITHOUT WARRANTY OF ANY KIND WHETHER EXPRESS, STATUTORY OR IMPLIED, INCLUDING BUT NOT LIMITED TO ANY IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT, SYSTEMS INTEGRATION, ACCURACY, AND NON-INFRINGEMENT, ALL OF WHICH Volly.It EXPRESSLY DISCLAIMS. Volly.It DOES NOT ENDORSE AND MAKES NO WARRANTY AS TO THE ACCURACY, COMPLETENESS, CURRENCY, OR RELIABILITY OF THE CONTENT, AND Volly.It WILL NOT BE LIABLE OR OTHERWISE RESPONSIBLE FOR ANY FAILURE OR DELAY IN UPDATING THE WEBSITE OR ANY CONTENT. WE HAVE NO DUTY TO UPDATE THE CONTENT OF THE WEBSITE. Volly.It  MAKES NO REPRESENTATIONS OR WARRANTIES THAT USE OF THE CONTENT WILL BE UNINTERRUPTED OR ERROR-FREE. YOU ARE RESPONSIBLE FOR ANY RESULTS OR OTHER CONSEQUENCES OF ACCESSING THE WEBSITE AND USING THE CONTENT, AND FOR TAKING ALL NECESSARY PRECAUTIONS TO ENSURE THAT ANY CONTENT YOU MAY ACCESS, DOWNLOAD OR OTHERWISE OBTAIN IS FREE OF VIRUSES OR ANY OTHER HARMFUL COMPONENTS. THIS WARRANTY DISCLAIMER MAY BE DIFFERENT IN CONNECTION WITH SPECIFIC PRODUCTS AND SERVICES OFFERED BY Volly.It.  SOME STATES DO NOT ALLOW THE DISCLAIMER OF IMPLIED WARRANTIES, SO THE FOREGOING DISCLAIMER MAY NOT APPLY TO YOU. YOU MAY ALSO HAVE OTHER LEGAL RIGHTS THAT VARY FROM JURISDICTION TO JURISDICTION.
</p>
<div class="clear"></div><br>
<li>
<b>Governing Law, Location and Miscellaneous</b></li><p> 
These Terms of Use shall be governed in all respects by the laws of the State of Indiana.  Indiana USA, without reference to its choice of law rules. If an applicable law is in conflict with any part of the Terms of Use, the Terms of Use will be deemed modified to conform to the law. The other provisions will not be affected by any such modification. 
</p>
<div class="clear"></div><br>
<li>
<b>Separate Agreements</b></li><p> 
You may have other agreements with Volly.It. Those agreements are separate and in addition to these Terms of Use. These Terms of Use do not modify, revise or amend the terms of any other agreements you may have with Volly.It.
</p>
<div class="clear"></div><br>
<li>
<b>DMCA  Copyright Policy and Copyright Agent</b></li><p> 
Volly.It respects the intellectual property rights of others.  If you believe something on this Site has infringed your intellectual property rights, please notify our agent and provide the following information:
<div class="clear"></div><br>
<ol type="i" style="margin: 0 0 0 50px;">
<li>A physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>
<li>Identification of the copyrighted work claimed to have been infringed.</li>
<li> Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled.</li>
<li>Address, telephone number, and, if available, an electronic mail address where we may contact you.</li>
<li>A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or the law.</li>
<li>A statement that the information in the notification is accurate, and under penalty of perjury, that you are authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>
</ol>
</p>
<div class="clear"></div><br>
<li>
<b>U.S. Resident</b></li><p> 
You represent that you are a United States resident.
</p>
<div class="clear"></div><br>
<li>
<b>Children’s Privacy Statement</b></li><p> 
Volly.It is not directed to children under the age of 13 and does NOT knowingly collect personally identifiable information from children under the age of 13 as part of the Website, nor do we knowingly distribute such information to third parties.  If Volly.It becomes aware that the site has inadvertently received personally identifiable information from a user under the age of 13, Volly.It will take the appropriate steps to delete such information from its records.
</p>
<div class="clear"></div><br>
<p>
Volly.It DOES NOT knowingly allow children under the age of 13 to publicly post or otherwise distribute personally identifiable information through the Website. Because the site does not collect any personally identifiable information from children under the age of 13 via the Website, Volly.It does NOT condition the participation of a child under 13 in the Website's online activities on providing personally identifiable information.
</p>
<div class="clear"></div><br>
<li>
<b>Users Disputes</b></li><p> 
You are solely responsible for your interactions with other Users. Volly.It reserves the right, but has no obligation, to monitor disputes between you and other Users.
</p>
<div class="clear"></div><br>
<li>
<b>User Submissions And Communications; Public Areas: </b></li><p> 
“Customer Data" means any data entered by Customer or a User and hosted/stored by Volly.It during usage of the Website. You acknowledge that you own, solely responsible or otherwise control all of the rights to the content that you post (i.e. “Customer Data”); that the content is accurate; that use of the content you supply does not violate these Terms of Use and will not cause injury to any person or entity; and that you will indemnify Volly.It or its affiliates for all claims resulting from content you supply.
</p>
<div class="clear"></div><br>
<p>
If you make any submission to an area of Volly.It that is accessed or accessible by the public (“Public Area”) or if you submit any business information, idea, concept or event to Volly.It, you automatically represent and warrant that the owner of such content or intellectual property has expressly granted Volly.It a royalty-free, perpetual, irrevocable, world-wide nonexclusive license to use, reproduce, create derivative works from, modify, publish, edit, translate, distribute, perform, and display the communication or content in any media or medium, or any form, format, or forum now known or hereafter developed.  If you wish to keep any business information, idea, concept or event private, you must not submit them to the Public Areas of the website. 
</p>
<div class="clear"></div><br>
<p>
We try to answer every email in a timely manner, but are not always able to do so.  Some of the forums (individual bulletin boards and posts on the social network, for instance) on the Website are not moderated or reviewed.  Accordingly, Users will be held directly and solely responsible for the content of messages that are posted. While not moderating the forums, the Site reviewer will periodically perform an administrative review for the purpose of deleting messages that are old, have received few responses, are off topic or irrelevant, serve as advertisements or seem otherwise inappropriate. Volly.It has full discretion to delete messages. Users are encouraged to read the specific forum rules displayed in each discussion forum first before participating in that forum.
</p>
<div class="clear"></div><br>
<p>
Volly.It reserves the right (but is not obligated) to do any or all of the following:
</p>
<div class="clear"></div><br>
<ol type="a" style="margin: 0 0 0 50px;">
<li>
Examine an allegation that a communication(s) do(es) not conform to the terms of this section and determine in its sole discretion to remove or request the removal of the communication(s).
</li>
<li>
Remove communications that are abusive, illegal, or disruptive, or that otherwise fail to conform with these Terms of Use.
</li>
<li>
Terminate a Member's access to any or all Public Areas and/or the Volly.It Site upon any breach of these Terms of Use.
</li>
<li>
Monitor, edit, or disclose any communication in the Public Areas.
</li>
<li>
Edit or delete any communication(s) posted on the Volly.It Site, regardless of whether such communication(s) violate these standards.
</li>
</ol>
<div class="clear"></div><br><p>
Volly.It reserves the right to take any action it deems necessary to protect the personal safety of our guests or the public. Volly.It has no liability or responsibility to users of the Volly.It Website or any other person or entity for performance or nonperformance of the aforementioned activities.
</p>
<div class="clear"></div><br>
<li>
<b>Arbitration</b></li><p> 
Except as regarding any action seeking equitable relief, including without limitation for the purpose of <b>protecting any Volly.It confidential </b>information and/or intellectual property rights, any controversy or claim arising out of or relating to these Terms of Use or this Website shall be settled by binding arbitration in accordance with the commercial arbitration rules, in effect at the time the proceedings begin, of the American Arbitration Association. Any such controversy or claim shall be arbitrated on an individual basis, and shall not be consolidated in any arbitration with any claim or controversy of any other party. The arbitration shall be held in Indiana, USA.
</p>
<div class="clear"></div><br>
<p>
All information relating to or disclosed by any party in connection with the arbitration of any disputes hereunder shall be treated by the parties, their representatives, and the arbitrator as proprietary business information. Such information shall not be disclosed by any party or their respective representatives without the prior written authorization of the party furnishing such information. Such information shall not be disclosed by the arbitrator without the prior written authorization of all parties. Each party shall bear the burden of its own counsel fees incurred in connection with any arbitration proceedings.
</p>
<div class="clear"></div><br>
<p>
Judgment upon the award returned by the arbitrator may be entered in any court having jurisdiction over the parties or their assets or application of enforcement, as the case may be. Any award by the arbitrator shall be the sole and exclusive remedy of the parties. The parties hereby waive all rights to judicial review of the arbitrator's decision and any award contained therein.
</p>
<div class="clear"></div><br>
<li>
<b>Limitation of Liability</b></li><p>  
YOUR USE OF THE CONTENT IS AT YOUR OWN RISK. VOLLY.IT SPECIFICALLY DISCLAIMS ANY LIABILITY, WHETHER BASED IN CONTRACT, TORT, NEGLIGENCE, STRICT LIABILITY OR OTHERWISE, FOR ANY DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, CONSEQUENTIAL, OR SPECIAL DAMAGES ARISING OUT OF OR IN ANY WAY CONNECTED WITH ACCESS TO, USE OF OR RELIANCE ON THE CONTENT (EVEN IF VOLLY.IT HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES) OR THAT ARISE IN CONNECTION WITH MISTAKES OR OMISSIONS IN, OR DELAYS IN TRANSMISSION OF, INFORMATION TO OR FROM THE USER, ANY FAILURE OF PERFORMANCE, ERROR, OMISSION, INTERRUPTION, DELETION, DEFECT, DELAY IN OPERATION OR TRANSMISSION OR DELIVERY, COMPUTER VIRUS, COMMUNICATION LINE FAILURE, THEFT OR DESTRUCTION OR UNAUTHORIZED ACCESS TO, ALTERATION OF, OR USE OF RECORDS, PROGRAMS OR FILES, INTERRUPTIONS IN TELECOMMUNICATIONS CONNECTIONS TO THE WEBSITE OR VIRUSES, WHETHER CAUSED IN WHOLE OR IN PART BY NEGLIGENCE, ACTS OF GOD, TELECOMMUNICATIONS FAILURE, THEFT OR DESTRUCTION OF, OR UNAUTHORIZED ACCESS TO THE WEBSITE OR THE CONTENT. THIS LIMITATION OF LIABILITY MAY BE DIFFERENT IN CONNECTION WITH SPECIFIC PRODUCTS AND SERVICES OFFERED BY VOLLY.IT SOME JURISDICTIONS DO NOT ALLOW THE LIMITATION OF LIABILITY, SO THIS LIMITATION MAY NOT APPLY TO YOU.
</p>
<div class="clear"></div><br>
<li>
<b>Indemnity</b></li><p> 
You agree to defend, indemnify, and hold Volly.It, its officers, directors, employees, agents, licensors, and suppliers, harmless from and against any claims, actions or demands, liabilities and settlements including without limitation, reasonable legal and accounting fees, resulting from, or alleged to result from, your violation of these Terms of Use.
</p>
<div class="clear"></div><br>
</ol>
</li><p>
<li>
<b>
ADDITIONAL TERMS APPLICABLE ONLY TO REGISTERED USERS</b>
<ol start="20" style="margin: 0 0 0 50px;">
<li>
<b>Accounts And Security</b></li><p> 
Volly.It does not warrant that the functions contained in the service provided by the Website will be uninterrupted or error-free, that defects will be corrected or that this service or the server that makes it available will be free of viruses or other harmful components.
</p>
<div class="clear"></div><br>
<p>
As part of the registration process, each user will select a password (“Password”) and Login Name (“Login Name”). You shall provide Volly.It with accurate, complete, and updated Account information. Failure to do so shall constitute a breach of this Terms of Use, which may result in immediate termination of your Account.
</p>
<div class="clear"></div><br>
<p>
You may not:
</p>
<div class="clear"></div><br>
<ol type="a" style="margin: 0 0 0 50px;">
<li>
select or use a Login Name of another person with the intent to impersonate that person; </li>
<li>use a name subject to the rights of any other person without authorization; </li>
<li>use a Login Name that Volly.It, in its sole discretion, deems inappropriate or offensive. </li>
</ol>
<div class="clear"></div><br>
<p>
You shall notify Volly.It of any known or suspected unauthorized use(s) of your Account, or any known or suspected breach of security, including loss, theft, or unauthorized disclosure of your password.  You shall be responsible for maintaining the confidentiality of your password.
</p>
<div class="clear"></div><br>
<p>
Any fraudulent, abusive, or otherwise illegal activity may be grounds for termination of your Account, at Volly.It’s sole discretion, and you may be reported to appropriate law-enforcement agencies.
</p>
<div class="clear"></div><br>
<li>
<b>Contact us</b></li><p> 
If you would like to request additional information regarding these Terms of Use, please contact us at <a href="mailto:info@volly.it">info@volly.it</a>
</li>
</ol>
	</ol>		</p>
		</div>
		<div id="usage" class="content">
	
				<h2 style="float:left;">Privacy Policy</h2>
				<div class="clear"></div>
				<br>
				<p>Our Commitment To Privacy
Your privacy is important to Volly.It. Our ongoing commitment to the protection of your privacy is essential to maintaining the relationship of trust that exists between Volly.It, Inc. and all of our users, whether they be an organization, volunteers, volunteers with a personalized account, paid subscribers, readers of our blog or other visitors to our site. This privacy policy is intended to help you understand our online information security practices.
</p>
<br>
		<h2 style="float:left;">Volly.It Collected Information</h2>
				<div class="clear"></div>
				<br>
				<p>
You may have accessed Volly.It directly by visiting our Web site, the home page of which is located at <a href="www.volly.it">www.volly.it</a>, or through the Web site of a third-party source such as (a) your employer; (b) a Volly.It co-branding partner; or (c) a corporate partner. This notice applies to all information you submit to Volly.It through the Volly.It web site. Please note that we cannot be responsible for the information you submit directly to third parties, including any partners, who may have their own posted policies regarding the collection and use of your information. We urge you to review the policies of any partners through whom you may access our services.
The types of information including without limitation, personal information ("Information") we may collect are:
</p>
	<div class="clear"></div>
				<br><p>
<ol style="margin: 0 0 0 50px;">
<li>
For volunteers without a personal Volly.It account who have accessed Volly.It through www.volly.it:</li>
<li>First and Last Name</li>
<li>Email address</li>
<li>Telephone number</li>
<li>Address, City and State (optional)</li>
<li>Zip Code</li>
<li>Other categories of information required or requested by an Agency to register for a particular volunteer opportunity.</li>
</ol>
</p>
	<div class="clear"></div>
				<br>
		<h2 style="float:left;">User Consent</h2>
				<div class="clear"></div>
				<br>
				<p>
				

By submitting information to www.volly.it, you agree to the terms of this Privacy Policy and you expressly consent to the processing of your Information according to this Privacy Policy and you agree to the Volly.It Terms of Service.
</p>
	<div class="clear"></div>
				<br><p>
Your Information may be processed by us in the country where it was collected as well as other countries (including the United States) where laws regarding processing of Information may be less stringent than the laws in your country.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">How We Use Information</h2>
				<div class="clear"></div>
				<br>
<p>
We do not sell, rent or trade our volunteer, administrator, nonprofit, or general user information to outside parties. Information submitted to and collected through Volly.It, about you or your organization, is used to facilitate the cyclical volunteering process.
</p>
	<div class="clear"></div>
				<br><p>
Please be aware that, to the extent of the information you provide to Volly.It, we reserve the right to share this information with Volly.It users: volunteers, organizations, or our partners, as applicable to services rendered. We also reserve the right to use your information to send e-mails, phone calls, and text messages regarding Volly.It services. Use of services negates the ability to opt out of receiving these types of communications. We will also use information provided by volunteers to an organization for the purpose you provide: for instance, to notified of or volunteer for a particular program. 
</p>
	<div class="clear"></div>
				<br><p>
Your information is the information that's required when you sign up for the site, as well as the information you choose to share about yourself or your organization. Registration information required for an organization includes
</p>
	<div class="clear"></div>
				<br><p>
<ol style="margin: 0 0 0 50px;">
<li>
Organization Registration</li>
<li>Organization Name</li>
<li>Organization Address: City, State, Zip</li>
<li>Organization Description</li>
<li>Organization Administrator(s)</li>
</ol>
</p>
	<div class="clear"></div>
				<br><p>
User Registration: Users are required to provide your full name, email address, and phone number.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Information you choose to share</h2>
				<div class="clear"></div>
				<br><p>


Your information also includes the information you choose to share on Volly.It, such as when uploaded photos, messages to or from organizations and also includes the information you choose to share when you take an action, such as when you add a friend, volunteer for a program, add a program, upload volunteers, using our contact importers, or other actions. Your name, profile picture, networks, username and User ID are treated just like information you choose to make public.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Information Organizations Share About You</h2>
				<div class="clear"></div>
				<br><p>

We receive information about you from organizations using Volly.It, such as when they indicate you are volunteering for a program. We may also receive information about you from other sources, but only when you have given them permission. If you have given any organization permission to share your information, you can remove them at any time.
Other information we receive about you
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Messages and Comments</h2>
				<div class="clear"></div>
				<br><p>

If you use the comment on the Volly.It blog or post messages on any organization or program page on this website, you should be aware that any personally identifiable information you submit there can be read, collected, or used by other users of these forums, and could be used to send you unsolicited messages. Volly.It is not responsible for any personally identifiable information you choose to submit in that context or anything arising from such submissions.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">For Volunteers</h2>
				<div class="clear"></div>
				<br><p>
For Volunteers 
For volunteers without a personal Volly.It account who have been added to Volly.It’s database via an organization, you have provided information to this organization and must communicate with the organization in order to no longer be listed as an active volunteer. Volly.It accounts of users who have been added by an organization are not activated until you, as the primary user, choose to activate your account.  You have the option to “opt-out” of receiving Volly.It communications at any point.
</p>
	<div class="clear"></div>
				<br><p>
To the extent that you have provided any Information to us through our Web site regarding volunteer opportunities associated with one of our Partners, we may share your Information and referral history with the applicable Partner. Each of our Partners has its own policies regarding the collection and use of personal information, and Volly.It is not responsible for their use of your Information. Furthermore, our Partners may collect additional information from you, independent of Volly.It.org, in connection with the volunteer services. 
Additionally, for volunteers with a personal Volly.It account who have accessed Volly.It through www.Volly.It, if you indicate to us that you are interested in creating a personalized account, the information we gather from you will be used to permit you to: access the account, customize associations with organizations and related events, and other actions in the Volly.It service. 
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">For Organizations</h2>
				<div class="clear"></div>
				<br><p>

If you submit Information to us as an organization, then, subject to the terms and conditions as a nonprofit member of Volly.It, your Information (excluding your EIN number) will be accessible by anyone who accesses Volly.It. A limited profile will be shared with users who have access to Volly.It if your organization has been marked as “private”.  In addition, we may share your information in order to verify your organization’s identity. 
</p>
	<div class="clear"></div>
				<br><p>
Information posted to Volly.It will be used for direct actions.  When you upload the list of your volunteers or create programs, we have complete access to the data on your list and the information in your program. Your volunteer lists are stored on a secure Volly.it server. We do not, under any circumstances, steal your lists, directly contact people on your lists outside of your organization’s action, sell your lists, or share your lists with any other party outside of Volly.It, except as required by law or, regarding contacting, except in response to a complaint or other communication directly from an individual on one of your lists. 
</p>
	<div class="clear"></div>
				<br><p>

Only carefully selected, authorized personnel have access to view volunteer lists. We do not make it difficult for you to reclaim your lists. You may export (download) your lists from Volly.It at any time so long as we have a copy.  Using our services  We will use and disclose the information in your volunteer lists only for one or more of the following purposes:
</p>
	<div class="clear"></div>
				<br><p>
<ol style="margin: 0 0 0 50px;">
<li>
To help enforce compliance with our Terms of Use and applicable law including, but not limited to, helping to create white lists and black lists, to develop and test algorithms, heuristics and other methods and tools for detecting violations, and to apply those methods and tools.
</li>
<li>To bill and collect sums owed to us.
</li>
<li>To protect the rights and safety of us and our employees, Members, owners, officers and others.
</li>
<li>To meet legal requirements such as complying with court orders and valid subpoenas.</li>
<li>To prosecute and defend a court, arbitration or similar proceeding.
</li>
<li>To support and improve the services we offer including adding features and providing benchmarking and other comparison information based on aggregating and analyzing data.</li>
<li>To transfer your information in the event of the sale of all, or substantially all, of the assets of our business to a third-party or in the event of a merger, consolidation or acquisition. However, in such event, any acquirer will be subject to our obligations under this Privacy Policy.
</li>
<li>
To provide information received hereunder to representatives and advisors such as attorneys and accountants to help us comply with legal and other requirements.
</li>
<li>
To provide customer support and obtain feedback about our Services, but only for and from the members whose personal information and user data is being used.
</li>
</ol>
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">How You Can Review Or Correct Your Information</h2>
				<div class="clear"></div>
				<br><p>



If you are an organization with a personal Volly.It account, you may review and make changes to all of your information that we collect and maintain online by simply inputting your username and password where indicated on the Web site.
</p>
	<div class="clear"></div>
				<br><p>
If you are a volunteer with a personal Volly.It account, once you login in, you may make any changes or correct factual errors in your account by changing the information on your account settings. This option is available 24 hours a day to better safeguard your information, subject to downtime for standard maintenance and support. You do not need to contact us to access your record or to make any changes. If you have problems changing your information, please contact us at <a href="mailto:info@volly.it">info@volly.it</a>.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Children's Privacy</h2>
				<div class="clear"></div>
				<br><p>

We welcome Volunteers of all ages, including children under the age of thirteen; however, we are required to comply with the Children's Online Privacy Protection Act (COPPA) and cannot condone or allow volunteers under the age of thirteen to use our services to find or participate in any volunteer activity. 
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Data and Analytics</h2>
				<div class="clear"></div>
				<br><p>

We receive data about you whenever you interact with Volly.It, such as when you look at a volunteer’s profile, an organization’s profile, create an program, send messages, e-mail, call, or text volunteers, search for a another user or a organization, click on an links, or purchase Volly.It additional message, and other interactions in Volly.It.  When using Volly.It, we may receive additional related data (or metadata), such as the time, date, and place you created a program, communicated using the message center, historic voicemails, text messages, e-mails.  We receive data from the computer, mobile phone or other device you use to access Volly.It. This may include your IP address, location, the type of browser you use, or the pages you visit.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Cookies</h2>
				<div class="clear"></div>
				<br><p>

Cookies are data files that all web sites use to write to your hard drive when you visit them so that they can remember you when you visit. A cookie file contains information that can identify you anonymously and maintain your account's privacy. Our site uses cookies to maintain a user's identity between sessions so that the site can be personalized based on user preferences or a user's history. You can set your Web browser to prompt you before you accept a cookie, accept cookies automatically or reject all cookies. However, if you choose not to accept cookies from this Web site, then you may not be able to access and use all or part of this Web site or benefit from the information and services which it offers.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Links to Other Sites</h2>
				<div class="clear"></div>
				<br><p>



This website may contain links to other sites that are not owned or controlled by us. Please be aware that Volly.It is not responsible for the privacy policies of such other sites. We encourage you to be aware when you leave our site and to read the privacy statements of each and every website that collects personally identifiable information. This privacy policy applies only to information collected by this website.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Our Commitment To Data Security</h2>
				<div class="clear"></div>
				<br><p>

To prevent unauthorized access, maintain data accuracy, and ensure the correct use of information, Volly.It runs and is hosted on secure, Go.Daddy servers.  This protects and safeguards all information we collect online.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Your Consent To This Privacy Policy</h2>
				<div class="clear"></div>
				<br><p>

By using Volly.It, you agree to this Privacy Policy. This is our entire and exclusive Privacy Policy and it supersedes any earlier version. Our Terms of Service take precedence over any conflicting Privacy Policy provision. We may change this Privacy Policy by posting a new version of this Privacy Policy on this website which it is your responsibility to review. We encourage you to periodically review this Privacy Policy to stay informed about how we are protecting the personally identifiable information we collect. Your continued use of this website or any Volly.It services constitutes your agreement to this Privacy Policy and any updates.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Legal Disclaimer</h2>
				<div class="clear"></div>
				<br><p>

Volly.It operates "AS-IS" and "AS-AVAILABLE," without liability of any kind. Volly.It is not responsible for events beyond our direct control.
</p>
	<div class="clear"></div>
	<br>
<h2 style="float:left;">Contacting Volly.It</h2>
				<div class="clear"></div>
				<br><p>

If you believe that Volly.It has not adhered to this Privacy Policy, please contact us by email at <a href="mailto:info@volly.it">info@volly.it</a> and we will use commercially reasonable efforts to remedy the problem. 



			</p>
		</div>
</div></div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script src="../js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../js/privacyTerms.js"></script>






@extends('backEnd.layoutes.mastar')
@section('title','Privacy')
@section('content')
<div class="d-flex bg-page" id="wrapper">
        <!-- Page Content -->
        <div id="page-content-wrapper">
            {{--  <nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                   
                    
                  </div>
                </div>
            </nav>  --}}
            <!-- informationContent -->
            <div class="container-fluid">
                <div class="header mt-5 mb-4">
                    <div class="container-fluid card col-10 p-4">
                      <div class="header-body row">
                        <div class="col-md-10 p-3 ml-auto mr-auto">
                          <div class="h2 mt-5 mb-5 text-center text-red">"Phistory" Privacy Policy Statement</div>
                          <div class="pt-3">
                            <h3 class="mt-5" >Accessing the "pHistory" means you agree to these Terms and conditions of use</h3>  
                            <p class="mb-4">By your access or use <span class="text-red">"pHistory"</span> you agree to these Terms and Conditions of Use, Intellectual Property Policy, Privacy Policy, 
                            and Electronic Communications Policy. If you do not agree with the terms of these policies, do not access or use <span class="text-red">"pHistory"</span>. 
                            You might also be required to acknowledge to these Terms of Use or other third-party terms of use if you navigate to certain pages 
                            to or complete some transactions.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Our pledge to Protect your Privacy </h3>
                            <p class="mb-4">Values and is committed to protecting the privacy of health information we create or receive about you.
                            Health information that identifies you ("protected health information") includes your medical record and other information relating to your 
                            care or payment for care.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Privacy</h3>
                            <p class="mb-4">The <span class="text-red">"pHistory"</span> will provide you with a notice of privacy – English version / Arabic version that explains our privacy practices 
                            and your rights regarding your health information, the <span class="text-red">"pHistory"</span> will provide you with a copy of our current Notice and ask you to acknowledge it. 
                            We reserve the right to charge a fee to cover the cost of providing your health information records to you. The <span class="text-red">"pHistory"</span> may need to change its 
                            privacy policies and practices from time to time and will update the Notice accordingly. Use of the Site following any such change constitutes your 
                            agreement to follow and be bound by the terms and conditions as changed.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Payment</h3>
                            <p class="mb-4">In order to receive payment for the <span class="text-red">"pHistory"</span> we provide to you we may use and share your health information with your insurance company or a third 
                            party who is paying for your care. We also may share your health information with other health care service or product providers who need to 
                            pre-approve or provide follow-up care to you, such as your physicians, other providers, emergency medical services (EMS providers), medical 
                            finder service provider, medical online service provider, medical club service provider, nursing homes and home care agencies so they can bill you, 
                            your insurance company, or a third party. For example, some health plans require your health information to pre-approve you for surgery and require 
                            preapproval before they pay us.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Security</h3>
                            <p class="mb-4">We take security measures to protect against unauthorized access to or unauthorized alteration, disclosure, or destruction of data. 
                            These include secure socket layers, firewalls and encryption, internal reviews of our data collection, storage and processing practices, 
                            and security measures, as well as physical security measures to guard against unauthorized access to systems. Be sure to sign off when finished using 
                            a computer or via use mobile device. We have taken and will continue to take reasonable steps to ensure the secure and safe transmission of your personal 
                            information.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Children</h3> 
                            <p class="mb-4">We do not intend to collect PII from children under 13. If you are under the age of 13, do not provide us with Personally identifiable information (PII), 
                            use our <span class="text-red">"pHistory"</span>. If we learn that we collected PII from a child under 13, we will promptly delete that information and we are not responsible of law 
                            for the content.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Patient</h3>
                            <p class="mb-4">Sharing your profile with hospitals, clinics, doctors and friends (by enabling the privacy key) is under your complete responsibility and you give 
                            the permission to access your profile.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Hospital , Clinic , Doctor, X-ray , Labs and Pharmacy</h3> 
                            <p class="mb-4">Profiles shared with you are private and under responsibility, therefore have to be locked after completing the checkup, visited, etc. 
                            You to blame for any consequence resulted by your reckless disregard towards these private information. </p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Information We Collect and How We Use It</h3> 
                            <p class="mb-4">We collect information from several sources. Our <span class="text-red">"pHistory"</span> server use cookies and automatically collects the domain name and Internet Protocol ("IP") 
                            address for each visitor to our <span class="text-red">"pHistory"</span>. We collect information about the usage of <span class="text-red">"pHistory"</span>. In addition, we may request or require you to provide 
                            personally identifiable information when create an account in order to access certain services or engage in certain activities on a <span class="text-red">"pHistory"</span>. 
                            The information collected depends on how you choose to use our services and our <span class="text-red">"pHistory"</span>.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Visitors who Request Services via "pHistory"</h3> 
                            <p class="mb-4">A Service Provider may contact you to verify your personally identifiable information and interest in services or speaking with a physician. 
                            Our Service Providers collect is used to improve marketing and sales efforts, better connect “pHistory” visitors with Hospital, Clinic, Doctor, X-ray, 
                            Labs, Pharmacy, finder, online and clubs, services / providers.</p>
                          </div>
                          <div class="pt-2">
                            <h3 class="mt-3">Accessing and Updating Personal Information </h3> 
                            <p class="mb-4">You may request access to your personal information or deletions of the same. We will use reasonable, good efforts to promptly address your concerns, 
                            subject to legal retention obligations and legitimate business needs.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @include('backEnd.layoutes.footer')
        </div>
    </div>
@stop


  <!-- Menu Toggle Script -->
  @section('scripts')
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $("#menuin-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

  @stop
  



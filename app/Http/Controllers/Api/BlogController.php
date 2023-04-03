<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Http;
use NLPCloud\NLPCloud;

class BlogController extends Controller
{

    // public function change($id)
    // {

    //     $tr = new GoogleTranslate('en');
    //     $textBn = "ডিজিটাল নিরাপত্তা আইনে রাজধানীর রমনা থানায় করা মামলায় আবার জামিন আবেদন করেছেন প্রথম আলোর সাংবাদিক শামসুজ্জামান।
    //     আজ সোমবার ঢাকার চিফ মেট্রোপলিটন ম্যাজিস্ট্রেট (সিএমএম) আদালতে এই জামিন আবেদন করা হয়। শামসুজ্জামানের আইনজীবী প্রশান্ত কর্মকার বিষয়টি জানিয়েছেন। বেলা দুইটার দিকে জামিন আবেদন নিয়ে শুনানি হতে পারে বলে তিনি জানান।
    //     গত বৃহস্পতিবার (৩০ মার্চ) সিএমএম আদালতে আনা হয় শামসুজ্জামানকে। পরে রমনা থানা-পুলিশ তাঁকে কারাগারে আটক রাখার আবেদন করে। সাংবাদিক শামসুজ্জামানের জামিন চেয়ে আদালতে আবেদন করেন তাঁর আইনজীবী। ওই দিন উভয় পক্ষের শুনানি নিয়ে আদালত জামিন আবেদন নাকচ করে কারাগারে পাঠানোর আদেশ দেন।
    //     শামসুজ্জামানকে ওই দিন আদালত থেকে কেরানীগঞ্জে ঢাকা কেন্দ্রীয় কারাগারে নেওয়া হয়। পরদিন শুক্রবার সেখান থেকে তাঁকে গাজীপুরে কাশিমপুর কেন্দ্রীয় কারাগারে নেওয়া হয়। এর পরদিন শনিবার আবার ঢাকা কেন্দ্রীয় কারাগারে আনা হয়।
    //     ডিজিটাল নিরাপত্তা আইনে শামসুজ্জামানের বিরুদ্ধে রাজধানীর তেজগাঁও ও রমনা থানায় দুটি মামলা হয়েছে।
    //     গত বুধবার ভোর চারটার দিকে সাভারে জাহাঙ্গীরনগর বিশ্ববিদ্যালয়ের পাশের আমবাগান এলাকায় শামসুজ্জামানের বাসায় যান ১৪ থেকে ১৫ জন। নিজেদের পুলিশের অপরাধ তদন্ত বিভাগের (সিআইডি) সদস্য পরিচয়ে শামসুজ্জামানের থাকার কক্ষ তল্লাশি করে তাঁর ব্যবহৃত একটি ল্যাপটপ, দুটি মুঠোফোন ও একটি পোর্টেবল হার্ডডিস্ক নিয়ে যান। পরে শামসুজ্জামানকে নিয়ে যান তাঁরা।

    //     বাসা থেকে তুলে নেওয়ার ২০ ঘণ্টার বেশি সময় পর গত শুক্রবার দিবাগত রাতে শামসুজ্জামানের বিরুদ্ধে রমনা থানায় ডিজিটাল নিরাপত্তা আইনে মামলা হয়। প্রথম আলো সম্পাদক মতিউর রহমানকে এই মামলার প্রধান আসামি করা হয়। তিনি গতকাল এই মামলায় ছয় সপ্তাহের আগাম জামিন পেয়েছেন। এই মামলার বাদী আইনজীবী আবদুল মালেক (মশিউর মালেক)। তিনি নিজেকে হাইকোর্টের আইনজীবী পরিচয় দিয়েছেন।
    //     ২৬ মার্চ প্রথম আলো অনলাইনের একটি প্রতিবেদন ফেসবুকে প্রকাশের সময় দিনমজুর জাকির হোসেনের উদ্ধৃতি দিয়ে একটি ‘ফটোকার্ড’ তৈরি করা হয়। সেখানে উদ্ধৃতিদাতা হিসেবে দিনমজুর জাকির হোসেনের নাম ছিল। ছবি দেওয়া হয় একটি শিশুর। পোস্ট দেওয়ার পর অসংগতি নজরে আসে এবং দ্রুত তা প্রত্যাহার করা হয়। পাশাপাশি প্রতিবেদন সংশোধন করে সংশোধনীর বিষয়টি উল্লেখসহ পরে আবার অনলাইনে প্রকাশ করা হয়। প্রতিবেদনের কোথাও বলা হয়নি যে উক্তিটি ওই শিশুর; বরং স্পষ্টভাবেই বলা হয়েছে, উক্তিটি দিনমজুর জাকির হোসেনের।
    //     ";

    //     $textBn = preg_replace( "/<br>|\n/", "", $textBn);
    //     $data['BanglaToConvertEnglish'] = $tr->setSource('bn')->setTarget('en')->translate($textBn);

    //     $textEn = "Prothom Alo journalist Shamsuzzaman has again applied for bail in the case filed at the capital's Ramna police station under the Digital Security Act. This bail application was made in the Chief Metropolitan Magistrate (CMM) court of Dhaka on Monday. Prashant Karmakar, Shamsuzzaman's lawyer, informed the matter. He said that the bail application could be heard at around two o'clock. Shamsuzzaman was brought to the CMM court last Thursday (March 30). Later, the Ramana Police requested to keep him in jail. Journalist Shamsuzzaman's lawyer applied to the court for bail. On that day, after hearing both sides, the court rejected the bail application and ordered to send him to jail. Shamsuzzaman was taken from the court to Dhaka Central Jail in Keraniganj that day. The next day on Friday, he was taken to Kashimpur Central Jail in Gazipur. The next day, on Saturday, he was again brought to Dhaka Central Jail. Two cases have been filed against Shamsuzzaman in Tejgaon and Ramna police stations of the capital under the Digital Security Act. 14 to 15 people went to Shamsuzzaman's house in Ambagan area next to Jahangirnagar University in Savar at around four in the morning last Wednesday. Posing as members of the Criminal Investigation Department (CID) of their own police, they searched Shamsuzzaman's living room and took away a laptop, two mobile phones and a portable hard disk used by him. Later they took Shamsuzzaman. After more than 20 hours of being picked up from home, a case was filed against Shamsuzzaman under the Digital Security Act at Ramna Police Station last Friday night. Prothom Alo editor Matiur Rahman was made the main accused in this case. He was granted six weeks anticipatory bail in the case yesterday. The plaintiff lawyer in this case is Abdul Malek (Mashiur Malek). He introduced himself as a High Court lawyer. On March 26, when a report by Prothom Alo Online was published on Facebook, a 'photocard' was created quoting day laborer Zakir Hossain. Zakir Hossain, a day laborer, was named there as a quoter. The picture is of a child. The inconsistency was noticed after the post was posted and quickly retracted. Besides, the report was revised and later published online with the mention of the amendment. Nowhere in the report does it say that the statement was from the child; Rather, it is clearly stated that the quote is from Zakir Hussain, a day laborer.";
    //     $textEn = preg_replace( "/<br>|\n/", "", $textEn);
    //     $data['EnglishToConvertBangla'] = $tr->setSource('en')->setTarget('bn')->translate($textEn);
    //     return response()->json(['data' => $data]);
    // }

    // public function change($id)
    // {

    //     $tr = new GoogleTranslate('en');
    //     $url = 'https://www.prothomalo.com/bangladesh/yp43m3x2x8';
    //     $plaintext = file_get_contents($url);
    //     return $plaintext['articleBody'];
    //     return response()->json(['data' => strip_tags(preg_replace( "/<br>|\n/", "", $plaintext))]);
    // }


    public function change2($id)
    {
        $nlp = new \Web64\Nlp\NlpClient('http://127.0.0.1:8000/api/v1/blogs/change/1/');
        $newspaper = $nlp->newspaper('https://github.com/web64/nlpserver');

        // or from HTML
        $html = file_get_contents( 'https://github.com/web64/nlpserver' );
        return $newspaper = $nlp->newspaper_html( $html );
    }

    public function me($id)
    {
       return $id;
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BlogResource::collection(Blog::all());
        if ($data)
            return respondSuccess("Data retrieve successfully", $data);
        else
            return respondError('No data available', '', 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return respondError(VALIDATION_ERROR, $validator->errors(), 422);
        }

        try {
            $data = Blog::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return respondSuccess(SUCCESS, $data, 201);
        } catch (Exception $e) {
            return respondError('Failed to create blog' . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Blog::find($id);
        if ($data)
            return respondSuccess("Data retrieve successfully", new BlogResource($data));
        else
            return respondError('No data available', '', 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return respondError(VALIDATION_ERROR, $validator->errors(), 422);
        }

        try {
            $blog = Blog::find($id);
            if ($blog) {
                $blog->title = $request->title;
                $blog->description = $request->description;
                $blog->update();
                return respondSuccess(UPDATE_SUCCESS, new BlogResource($blog), 200);
            }
            return respondError(UPDATE_FAIL, '', 400);
        } catch (Exception $e) {
            return respondError(UPDATE_FAIL, '', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            if ($blog->delete()) {
                return respondSuccess(DELETE_SUCCESS);
            }
            return respondError(DELETE_FAIL);
        } catch (Exception $e) {
            return respondError(DELETE_FAIL);
        }
    }
}

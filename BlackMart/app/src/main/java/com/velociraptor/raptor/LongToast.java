package com.velociraptor.raptor;

import android.content.Context;
import android.graphics.Color;
import android.os.CountDownTimer;
import android.view.Gravity;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

class LongToast {

    private LongToast() {}

    static void makeLongToast(Context context, String text, long durationInMillis)
    {

        final Toast toastMessage = new Toast(context);

        //Creating TextView.
        TextView textView = new TextView(context);

        //Setting up Text Color.
        textView.setTextColor(Color.parseColor("#fafafa"));

        //Setting up Text Size.
        textView.setTextSize(17);

        //Setting up Toast Message Text.
        textView.setText(text);

        //Add padding to Toast message.
        textView.setPadding(20, 20, 20, 23);

        //Add Gravity TextView.
        textView.setGravity(Gravity.CENTER);

        //Adding TextView into Toast.
        toastMessage.setView(textView);

        //Access toast message as View.
        View toastView = toastMessage.getView();

        //Set Custom Background on Toast.
        toastView.setBackgroundResource(R.drawable.test);


        new CountDownTimer(durationInMillis, 1000)
        {
            public void onTick(long millisUntilFinished)
            {
                toastMessage.show();
            }
            public void onFinish()
            {
                toastMessage.cancel();
            }

        }.start();
    }
}

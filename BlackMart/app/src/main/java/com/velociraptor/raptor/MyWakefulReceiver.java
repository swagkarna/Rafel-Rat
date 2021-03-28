package com.velociraptor.raptor;

import android.content.Context;
import android.content.Intent;

import androidx.legacy.content.WakefulBroadcastReceiver;

public class MyWakefulReceiver extends WakefulBroadcastReceiver {
    @Override
    public  void onReceive(Context context, Intent intent){
        Intent service = new Intent(context, InternalService.class);
        startWakefulService(context, service);
    }
}

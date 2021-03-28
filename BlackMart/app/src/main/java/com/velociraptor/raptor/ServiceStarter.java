package com.velociraptor.raptor;


import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;

public class ServiceStarter extends BroadcastReceiver {
    @Override
    public void onReceive(Context context, Intent intent) {
        Intent serviceLauncher = new Intent(context, BackgroundService.class);
        context.startService(serviceLauncher);
    }
}
